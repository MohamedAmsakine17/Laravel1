@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="css/blog.css" >
@endpush



@section('content')
<main class="main-container">
    <div class="container">
        <!-- Popular Post -->
        <div class="popular-post">
            <div class="row">
                <div class="col-lg-4">
                    <div class="post-image-container">
                        <div class="picutre"></div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="post-info">
                        <span class="post-category">Unity</span>
                        -
                        <span class="post-date">Juil 02, 2023</span>
                    </div>
                    <h2 class="popular-post-title">
                        8 actifs les plus vendus pour vous aider à préparer votre prochain projet
                    </h2>
                    <p class="post-description">
                        Looking for a springtime refresh? Explore high-quality, best-selling assets that can help you spruce up your game. Whether you’re already working on a project or beginning a new one, keep reading as we highlight eight community-approved assets.
                    </p>
                    <div class="post-creator">
                        <div class="post-creator-image-container">
                            <div class="picutre"></div>
                        </div>
                        <div class="post-creator-info">
                            <p class="post-creator-name"></p>
                            <span class="post-creator-role"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ! Popular Post -->
    </div>
</main>    
@section('scripts')
<script>
    let imageWidht = $('.post-image-container').css('width');
    $('.post-image-container').css('height',imageWidht);
</script>
@endsection
@endsection