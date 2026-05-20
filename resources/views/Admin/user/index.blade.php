@extends('layouts.admin')

@section('title', 'Data User')
@section('subtitle', 'Kelola data pengguna sistem dan aktivitasnya')

@section('content')

<div class="mb-6 flex flex-col gap-3 lg:flex-row lg:items-end lg:justify-between">
    <div>
        <div class="mb-2 text-mono-label text-muted">Pengguna</div>
        <h2 class="text-section-heading m-0 text-ink">Data User</h2>
        <p class="mt-2 max-w-2xl text-caption text-muted">Daftar akun petani dan pengguna sistem yang dapat mengakses analisis dan edukasi.</p>
    </div>
    <div class="rounded-full border border-border-light bg-canvas px-4 py-2 text-caption text-muted">
        Total <span class="font-medium text-ink">{{ $users->count() }}</span> user terdaftar
    </div>
</div>

@if(session('success'))
<div class="contact-form-card mb-6 border border-deep-green/15 bg-pale-green px-5 py-4 text-deep-green">
    <div class="flex items-start gap-3">
        <i data-lucide="check-circle-2" class="mt-0.5 h-5 w-5"></i>
        <div>{{ session('success') }}</div>
    </div>
</div>
@endif

<div class="contact-form-card p-0 overflow-hidden">
    <div class="border-b border-border-light bg-canvas px-6 py-4">
        <div class="flex items-center justify-between gap-4">
            <h3 class="text-card-heading m-0 text-ink">Akun pengguna</h3>
            <span class="text-mono-label text-muted">Users</span>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full border-collapse text-left">
            <thead>
                <tr class="border-b border-border-light bg-soft-stone/60 text-mono-label text-muted">
                    <th class="px-6 py-4 font-medium">No</th>
                    <th class="px-6 py-4 font-medium">Nama</th>
                    <th class="px-6 py-4 font-medium">Email</th>
                    <th class="px-6 py-4 font-medium">Total Analisis</th>
                    <th class="px-6 py-4 font-medium">Tanggal Daftar</th>
                    <th class="px-6 py-4 font-medium">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border-light">
                @forelse($users as $user)
                <tr class="transition-colors hover:bg-soft-stone/30">
                    <td class="px-6 py-5 text-body text-muted">{{ $loop->iteration }}</td>
                    <td class="px-6 py-5">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-pale-green text-deep-green">
                                <i data-lucide="user" class="h-5 w-5"></i>
                            </div>
                            <div>
                                <div class="text-body font-medium text-ink">{{ $user->name }}</div>
                                <div class="text-caption text-muted">ID user #{{ $user->id }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-5 text-body text-muted">{{ $user->email }}</td>
                    <td class="px-6 py-5">
                        <span class="inline-flex items-center rounded-full border border-border-light bg-canvas px-3 py-1 text-caption text-ink">
                            {{ $user->hasil_analisis_count }} analisis
                        </span>
                    </td>
                    <td class="px-6 py-5 text-caption text-muted">{{ $user->created_at->format('d M Y') }}</td>
                    <td class="px-6 py-5">
                        <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin hapus user ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center gap-2 rounded-full border border-error/20 px-3 py-2 text-caption text-error transition-colors hover:bg-error hover:text-white">
                                <i data-lucide="trash-2" class="h-4 w-4"></i>
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-10 text-center text-body text-muted">Belum ada user terdaftar</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection