import gsap from 'gsap';
import ScrollTrigger from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

const motionQuery = window.matchMedia('(prefers-reduced-motion: reduce)');

// Respect explicit user toggle stored in localStorage: 'siteAnimations' = 'on'|'off'
function animationsEnabled() {
	return false;
}

function stopMotion() {
	try {
		ScrollTrigger.getAll().forEach((t) => t.kill());
	} catch (e) {}
	try {
		gsap.killTweensOf('*');
	} catch (e) {}
}

const directionOffsets = [
	{ x: 0, y: -72 },
	{ x: 0, y: -48 },
	{ x: 0, y: 48 },
	{ x: 0, y: 24 },
];

const revealFamilies = [
	{ selector: 'main section, main article, main > div, footer > div', strength: 1, duration: 1.05 },
	{ selector: 'main h1, main h2, main h3, main h4, main h5, main h6', strength: 0.7, duration: 0.9 },
	{ selector: 'main p, main li, main tr, main .text-caption, main .text-body, main .text-body-large', strength: 0.45, duration: 0.75 },
	{ selector: 'main .hero-photo-card, main .agent-console-card, main .product-card, main .capability-card, main .contact-form-card, main .research-table-row', strength: 0.9, duration: 1 },
	{ selector: 'main .btn-primary, main .btn-secondary, main .btn-pill-outline, main .blog-filter-chip', strength: 0.6, duration: 0.8 },
	{ selector: 'main .form-input, main .form-select, main .form-textarea', strength: 0.35, duration: 0.65 },
];

function getOffset(index, strength) {
	const direction = directionOffsets[index % directionOffsets.length];

	return {
		x: direction.x * strength,
		y: direction.y * strength,
	};
}

function animateLoadTargets() {
	const header = document.querySelector('header');
	const announcementBar = document.querySelector('.announcement-bar');
	const footer = document.querySelector('footer');

	gsap.from([announcementBar, header].filter(Boolean), {
		opacity: 0,
		y: -18,
		duration: 0.8,
		stagger: 0.12,
		ease: 'power2.out',
	});

	if (footer) {
		gsap.from(footer, {
			opacity: 0,
			y: 24,
			duration: 0.9,
			ease: 'power2.out',
			scrollTrigger: {
				trigger: footer,
				start: 'top 92%',
				once: true,
			},
		});
	}
}

function animateRevealFamily(selector, strength, duration) {
	const elements = gsap.utils.toArray(selector).filter((element) => {
		return element instanceof Element && !element.closest('.hidden');
	});

	if (!elements.length) {
		return;
	}

	ScrollTrigger.batch(elements, {
		interval: 0.08,
		batchMax: 4,
		start: 'top 86%',
		once: true,
		onEnter: (batch) => {
			batch.forEach((element, index) => {
				const offset = getOffset(index, strength);

				gsap.fromTo(
					element,
					{
						opacity: 0,
						x: offset.x,
						y: offset.y,
						rotate: offset.x !== 0 ? (offset.x < 0 ? -2 : 2) : 0,
					},
					{
						opacity: 1,
						x: 0,
						y: 0,
						rotate: 0,
						duration,
						ease: 'power3.out',
						clearProps: 'transform',
					}
				);
			});
		},
	});
}

function animateFloatingAccents() {
	const accents = document.querySelectorAll(
		'.dark-feature-band .absolute.rounded-full, .agent-console-card .w-3.h-3.rounded-full, .hero-photo-card .w-12.h-12.rounded-full'
	);

	accents.forEach((accent, index) => {
		gsap.to(accent, {
			y: index % 2 === 0 ? -12 : 12,
			x: index % 2 === 0 ? 6 : -6,
			duration: 5 + index,
			repeat: -1,
			yoyo: true,
			ease: 'sine.inOut',
		});
	});
}

function setProgressImmediate() {
	// Handled by dynamic high-fidelity intersection animations in welcome.blade.php
}

function animateProgressBars() {
	const bars = gsap.utils.toArray('.progress-bar');
	if (!bars.length) return;

	bars.forEach((bar) => {
		const target = parseFloat(bar.getAttribute('data-target') || '0');
		const fill = bar.querySelector('.progress-fill');
		// value element may be previous sibling's .progress-value
		let valueEl = null;
		const prev = bar.previousElementSibling;
		if (prev) valueEl = prev.querySelector && prev.querySelector('.progress-value');

		if (!fill) return;

		gsap.fromTo(
			fill,
			{ width: '0%' },
			{
				width: `${target}%`,
				duration: 1.4,
				ease: 'power2.out',
				scrollTrigger: {
					trigger: bar,
					start: 'top 90%',
					once: true,
				},
			}
		);

		if (valueEl) {
			const obj = { val: 0 };
			gsap.to(obj, {
				val: target,
				duration: 1.4,
				ease: 'power2.out',
				scrollTrigger: {
					trigger: bar,
					start: 'top 90%',
					once: true,
				},
				onUpdate: function () {
					valueEl.textContent = `${(Math.round(obj.val * 10) / 10).toFixed(1)}%`;
				},
			});
		}
	});
}

function initMotion() {
	document.documentElement.classList.add('gsap-ready');
	document.body.classList.add('no-animations');
	stopMotion();
	setProgressImmediate();
	return;
}



if (document.readyState === 'loading') {
	document.addEventListener('DOMContentLoaded', initMotion, { once: true });
} else {
	initMotion();
}

// Animation toggle in header
document.addEventListener('DOMContentLoaded', function () {
	const btn = document.getElementById('toggle-animations');
	if (!btn) return;

	function updateButton() {
		const enabled = animationsEnabled();
		btn.textContent = enabled ? 'Matikan Animasi' : 'Nyalakan Animasi';
	}

	btn.addEventListener('click', function () {
		const enabled = animationsEnabled();
		if (enabled) {
			localStorage.setItem('siteAnimations', 'off');
			stopMotion();
			document.body.classList.add('no-animations');
			updateButton();
		} else {
			localStorage.setItem('siteAnimations', 'on');
			document.body.classList.remove('no-animations');
			// re-init animations
			initMotion();
			updateButton();
		}
	});

	updateButton();
});

// Video modal – open iframe with YouTube video id set on button data attribute
document.addEventListener('click', function (e) {
	const play = e.target.closest && e.target.closest('.hero-play');
	if (play) {
		const id = play.getAttribute('data-video-id');
		const modal = document.getElementById('video-modal');
		const iframe = document.getElementById('video-iframe');
		if (modal && iframe) {
			iframe.src = id ? `https://www.youtube.com/embed/${id}?autoplay=1&rel=0` : '';
			modal.classList.add('show');
			modal.classList.remove('hidden');
		}
	}

	const close = e.target.closest && e.target.closest('#video-modal-close');
	if (close) {
		const modal = document.getElementById('video-modal');
		const iframe = document.getElementById('video-iframe');
		if (modal && iframe) {
			iframe.src = '';
			modal.classList.remove('show');
			modal.classList.add('hidden');
		}
	}
});

// Smooth scrolling for in-page anchors and active nav highlighting
function initSmoothScrollAndNavHighlight() {
	const anchorLinks = Array.from(document.querySelectorAll('a[href^="#"]'));

	anchorLinks.forEach((link) => {
		const href = link.getAttribute('href');
		if (!href || href === '#') return;
		link.addEventListener('click', function (ev) {
			ev.preventDefault();
			const target = document.querySelector(href);
			if (target) {
				target.scrollIntoView({ behavior: 'smooth', block: 'start' });
				// close mobile menu if open
				const mobile = document.getElementById('mobile-menu');
				if (mobile && !mobile.classList.contains('hidden')) {
					mobile.classList.add('hidden');
				}
			}
		});
	});

	// Map sections to nav links
	const navMap = new Map();
	anchorLinks.forEach((link) => {
		const href = link.getAttribute('href');
		if (!href || !href.startsWith('#') || href === '#') return;
		const id = href.slice(1);
		const el = document.getElementById(id);
		if (el) navMap.set(id, link);
	});

	const sections = Array.from(document.querySelectorAll('section[id], footer[id], header[id]'));
	if (!sections.length) return;

	const observer = new IntersectionObserver(
		(entries) => {
			entries.forEach((entry) => {
				const id = entry.target.id;
				const link = navMap.get(id);
				if (!link) return;
				if (entry.isIntersecting) {
					link.classList.add('is-active');
				} else {
					link.classList.remove('is-active');
				}
			});
		},
		{ root: null, rootMargin: '-30% 0px -40% 0px', threshold: 0 }
	);

	sections.forEach((s) => observer.observe(s));
}

if (document.readyState === 'loading') {
	document.addEventListener('DOMContentLoaded', initSmoothScrollAndNavHighlight, { once: true });
} else {
	initSmoothScrollAndNavHighlight();
}
