<div>
    <table class="table table-striped mt-4">
        <thead class="users-table-thead">
            <tr>
                <th scope="col">
                    <div class="d-flex">
                        <p class="m-0 th-text">Id </p>
                        <button wire:click.prevent="filter('id')"  href="" class="filter-button" id="ids">
                            <span class="material-icons-outlined ">
                                import_export
                            </span>
                        </button>
                    </div>
                </th>
                <th scope="col">
                    <div class="d-flex">
                        <p class="m-0 th-text">Nom</p>
                        <button wire:click.prevent="filter('name')" class="filter-button" id="nom">
                            <span class="material-icons-outlined ">
                                import_export
                            </span>
                        </button>
                    </div>
                </th>
                <th scope="col" class="table-data-mobile">
                    <div class="d-flex">
                        <p class="m-0 th-text">Titre</p>
                        <button wire:click.prevent="filter('title')" class="filter-button" id="nom">
                            <span class="material-icons-outlined ">
                                import_export
                            </span>
                        </button>
                    </div>
                </th>
                <th scope="col" class="table-data-mobile">
                    <div class="d-flex">
                        <p class="m-0 th-text">Vendeur</p>
                    </div>
                </th>
                <th scope="col" class="table-data-mobile">
                    <div class="d-flex">
                        <p class="m-0 th-text">Prix</p>
                        <button wire:click.prevent="filter('price')" class="filter-button" id="nom">
                            <span class="material-icons-outlined ">
                                import_export
                            </span>
                        </button>
                    </div>
                </th>
                <th scope="col" class="table-data-mobile">
                    <div class="d-flex">
                        <p class="m-0 th-text">Vues</p>
                        <button wire:click.prevent="filter('views')" class="filter-button" id="nom">
                            <span class="material-icons-outlined ">
                                import_export
                            </span>
                        </button>
                    </div>
                </th>
                <th scope="col" class="table-data-mobile">
                    <div class="d-flex">
                        <p class="m-0 th-text">Téléchargements</p>
                        <a href="" class="filter-button">
                            <span class="material-icons-outlined ">
                                import_export
                            </span>
                        </a>
                    </div>
                </th>
                <th scope="col" class="table-data-mobile">
                    <div class="d-flex">
                        <p class="m-0 th-text">Épingle</p>
                    </div>
                </th>
                <th scope="col" class="table-data-mobile">
                    <div class="d-flex">
                        <p class="m-0 th-text">Modification</p>
                    </div>
                </th>
                <th scope="col" class="table-data-mobile">
                    <div class="d-flex">
                        <p class="m-0 th-text">Suppression</p>
                    </div>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($articles as $article)
                <tr scope="row">
                   <td>{{$article->id}}</td>
                   <td><a class="link" href="/article/{{$article->id}}">{{$article->name}}</a></td>
                   <td class="table-data-mobile">{{$article->title}}</td>
                   <td class="table-data-mobile">{{$article->user->name}}</td>
                   <td class="table-data-mobile">{{$article->price}}</td>
                   <td class="table-data-mobile">{{$article->views}}</td>
                   <td class="table-data-mobile">{{$article->downloads}}</td>
                   <td class="table-data-mobile">
                    @if ($article->pin)
                        <div class="d-flex justify-content-center">
                            <input class="form-check-input" type="checkbox" name="pin" id="pin" onChange="this.form.submit()" checked>                         
                        </div>
                    @else
                        <form id="pin-article-form" action="{{route("adminPins",$article->id)}}" method="POST" class="d-flex justify-content-center">
                            @csrf
                            <input class="form-check-input" type="checkbox" name="pin" id="pin" onChange="this.form.submit()">                         
                        </form>
                    @endif
               </td>
                   <td class="table-data-mobile"> 
                        <a href="/article/{{$article->id}}/edit" class="yellow-button">Modifier</a>
                   </td>
                   <td class="table-data-mobile">
                        <form id="delete-article-form" action="/article/{{$article->id}}" method="POST">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="submit" class="red-button" value="Supprimer">
                        </form>
                   </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
                                
    <div class="articles-pages">
        {{ $articles->links() }}
    </div>
</div>
