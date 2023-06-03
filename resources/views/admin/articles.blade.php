@extends('layouts.admin')

@push('css')
    <link rel="stylesheet" href="../../css/admin.css">
    
@endpush

@section('content')
<main class="dashboard-main">
                <div class="dashboard-right-container">

                    <div class="container">

                        <div class="dashboard-header">
                            <h2>Articles</h2>
                            
                        </div>
                        <hr>

                        <div class="articles-container">
                            <div class="admin-data-container">
                                <a class="green-button create-article-button mt-3" href="/article/create"> <i class="bi bi-patch-plus me-3"></i><span>Ajouter un nouveau produit</span></a>
                            </div>
                            <div class="admin-data-container">
                                <livewire:articles /> 
                            </div>
                           
                        </div>
                    </div>
                    
                </div>

        

</main>


@endsection