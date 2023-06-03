<div>
    <table class="table table-striped mt-4">
        <thead class="users-table-thead">
            <tr>
                <th scope="col">
                    <div class="d-flex">
                        <p class="mb-0 th-text">id</p>
                        <button wire:click.prevent="filter('id')" class="filter-button" id="nom">
                            <span class="material-icons-outlined ">
                                import_export
                            </span>
                        </button>
                    </div>
                </th>
                <th scope="col"  class="table-data-mobile">
                    <p class="mb-0 th-text">img</p>
                </th>
                <th scope="col"  class="table-data-mobile">
                    <div class="d-flex">
                        <p class="mb-0 th-text">rôle</p>
                         <button wire:click.prevent="filter('role_id')" class="filter-button" id="nom">
                             <span class="material-icons-outlined ">
                                 import_export
                             </span>
                         </button>
                    </div>
                </th>
                <th scope="col">
                    <div class="d-flex">
                        <p class="mb-0 th-text">Nom d'utilisateur</p>
                        <button wire:click.prevent="filter('name')" class="filter-button" id="nom">
                            <span class="material-icons-outlined ">
                                import_export
                            </span>
                        </button>
                    </div>
                </th>
                <th scope="col"  class="table-data-mobile">
                    <div class="d-flex">
                        <p class="mb-0 th-text">Email</p>
                        <button wire:click.prevent="filter('email')" class="filter-button" id="nom">
                            <span class="material-icons-outlined ">
                                import_export
                            </span>
                        </button>
                    </div>
                </th>
                <th scope="col"  class="table-data-mobile">Suppression</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr scope="row">
                    <td>{{$user->id}}</td>
                    <td  class="table-data-mobile"><div class="user-picture" style= "background-image: url(/{{$user->path}}); background-repeat: no-repeat; background-size: cover; background-position: center;"></div></td>
                    <td  class="table-data-mobile">
                        {{$user->role->name}}
                    </td >
                    <td>{{$user->name}}</td>
                    <td  class="table-data-mobile">{{$user->email}}</td>
                    <td  class="table-data-mobile">
                        @if($user->role->name != 'admin')
                            <button type="button" class="red-button"  data-toggle="modal" data-target="#supprimerModalCenter">
                                Supprimer
                                <form id="delete-user-form" action="/admin/delete/user/{{$user->id}}" method="POST" class="d-none">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE">
                                </form>
                            </button>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="articles-pages">
        {{ $users->links() }}
    </div>
</div>
