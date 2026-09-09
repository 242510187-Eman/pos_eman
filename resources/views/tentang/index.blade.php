@extends('layouts.app')

@section('content')
<div class="py-5 min-vh-100 d-flex align-items-center" style="background: radial-gradient(circle at 10% 20%, rgba(22, 163, 74, 0.05) 0%, transparent 40%), radial-gradient(circle at 90% 80%, rgba(79, 70, 229, 0.05) 0%, transparent 40%);">
    <div class="container">
        
        <div class="row justify-content-center">
            <div class="col-lg-9">
                
                <!-- Main Glassmorphism Card -->
                <div class="card border-0 shadow-2lg rounded-5 text-white overflow-hidden" style="background: rgba(15, 23, 42, 0.9); backdrop-filter: blur(30px); border: 1px solid rgba(255, 255, 255, 0.08) !important;">
                    
                    <!-- Top Accent Line -->
                    <div class="w-100" style="height: 4px; background: linear-gradient(90deg, #16a34a, #4f46e5);"></div>

                    <div class="p-4 p-md-5">
                        
                        <!-- Header Profile Section -->
                        <div class="d-flex flex-column flex-md-row align-items-center gap-4 pb-5 border-bottom border-secondary border-opacity-10">
                            <!-- Avatar with Glow -->
                            <div class="position-relative flex-shrink-0">
                                <div class="position-absolute rounded-circle bg-success opacity-25 blur-sm" style="inset: -4px; filter: blur(8px);"></div>
                                <div class="rounded-circle overflow-hidden position-relative border-2 border-success shadow-lg" style="width: 120px; height: 120px;">
                                    <img src="{{ asset('images/pos.jpg') }}" alt="Eman" class="w-100 h-100 object-fit-cover">
                                </div>
                            </div>

                            <!-- Bio Header -->
                            <div class="text-center text-md-start">
                                <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-success bg-opacity-10 text-success fw-medium small mb-2">
                                    <i class="bi bi-patch-check-fill"></i> Verified Developer
                                </div>
                                <h1 class="fw-bold text-white fs-3 mb-1">Eman</h1>
                                <p class="text-white-50 small mb-3">Lead System Engineer & Creator of POS Eman</p>
                                <p class="text-light small fst-italic mb-0 opacity-75">
                                    "Menghadirkan efisiensi mutlak dalam setiap baris kode untuk pengalaman kasir digital yang tanpa cela."
                                </p>
                            </div>
                        </div>

                        <!-- Grid Specifications -->
                        <div class="row g-4 pt-4">
                            
                            <!-- About System Box -->
                            <div class="col-md-6">
                                <div class="p-4 rounded-4 h-100 d-flex flex-column justify-content-between" style="background: rgba(30, 41, 59, 0.45); border: 1px solid rgba(255, 255, 255, 0.04);">
                                    <div>
                                        <div class="d-flex align-items-center gap-2 mb-3 text-success">
                                            <i class="bi bi-grid-1x2-fill fs-5"></i>
                                            <h6 class="fw-bold text-white mb-0">Tentang POS Eman</h6>
                                        </div>
                                        <p class="text-white-50 small lh-relaxed mb-0">
                                            Sistem Point of Sales terintegrasi yang dirancang untuk mengoptimalkan alur transaksi harian, manajemen inventaris akurat, serta kontrol penuh terhadap performa bisnis secara real-time.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Tech Stack Box -->
                            <div class="col-md-6">
                                <div class="p-4 rounded-4 h-100" style="background: rgba(30, 41, 59, 0.45); border: 1px solid rgba(255, 255, 255, 0.04);">
                                    <div class="d-flex align-items-center gap-2 mb-3 text-indigo" style="color: #818cf8;">
                                        <i class="bi bi-terminal-fill fs-5"></i>
                                        <h6 class="fw-bold text-white mb-0">Teknologi Inti</h6>
                                    </div>
                                    
                                    <div class="d-flex flex-column gap-2 small">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="text-white-50">Core Engine</span>
                                            <span class="text-light fw-medium">PHP 8.4 / JS</span>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="text-white-50">Framework</span>
                                            <span class="text-light fw-medium">Laravel 12</span>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="text-white-50">UI Layout</span>
                                            <span class="text-light fw-medium">Bootstrap 5</span>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="text-white-50">Database</span>
                                            <span class="text-light fw-medium">MySQL</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection