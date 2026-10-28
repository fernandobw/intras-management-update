@extends('layouts.admin.admin')

@section('header_scripts')

    <style>
        table a {
            color: black;
            text-decoration: none;
        }

        table a:hover {
            color: #3071a9;
            text-decoration: none;
        }

    </style>

@endsection

@section('content')

    <section class="section-padding">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger" style="padding-bottom: 0px;">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <table id="items" class="display dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Titulo</th>
                                <th>Etiqueta</th>
                                <th>Destacado</th>
                                <th>Publicado</th>
                                <th>Categoria</th>
                                <th>Creado</th>
                                <th>Modificado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Titulo</th>
                                <th>Etiqueta</th>
                                <th>Destacado</th>
                                <th>Publicado</th>
                                <th>Categoria</th>
                                <th>Creado</th>
                                <th>Modificado</th>
                                <th>Acciones</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('scripts_footer')

    <script>
        $(document).ready(function() {
            var csrf = '<?php echo csrf_field(); ?>';
            $('#items').DataTable({
                "ajax": "<?php echo url('/admin/items/all'); ?>",
                "order": [
                    [0, "desc"] //Filtrar por id desc
                ],
                "columns": [{
                        "data": "id"
                    },
                    {
                        "data": "title",
                        "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                            $(nTd).html(`<a href="/admin/items/${oData.id}">${oData.title}</a>`);
                        }
                    },
                    {
                        "data": "tag_name",
                        "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                            $(nTd).html(`<span>${oData.tag_name}</span>`);
                        }
                    },
                    {
                        "data": "featured",
                        "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                            if (oData.featured == '1') {
                                $(nTd).html("<form action='/admin/items/" + oData.id +
                                    "/update/featured' method='post'>" + csrf +
                                    "<button type='submit' style='font-size: 11px;'><i class='fa fa-check' style='color: #3E843E;'></i></button></form>"
                                );
                            } else {
                                $(nTd).html("<form action='/admin/items/" + oData.id +
                                    "/update/featured' method='post'>" + csrf +
                                    "<button type='submit' style='font-size: 11px;'><i class='fa fa-times-circle' style='color: #A52A25;'></i></button></form>"
                                );
                            }

                        }
                    },
                    {
                        "data": "published",
                        "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {

                            if (oData.published == '1') {
                                $(nTd).html("<form action='/admin/items/" + oData.id +
                                    "/update/published' method='post'>" + csrf +
                                    "<button type='submit' style='font-size: 11px;'><i class='fa fa-check' style='color: #3E843E;'></i></button></form>"
                                );
                            } else {
                                $(nTd).html("<form action='/admin/items/" + oData.id +
                                    "/update/published' method='post'>" + csrf +
                                    "<button type='submit' style='font-size: 11px;'><i class='fa fa-times-circle' style='color: #A52A25;'></i></button></form>"
                                );
                            }

                        }
                    },
                    {
                        "data": "category_name"
                    },
                    {
                        "data": "created"
                    },
                    {
                        "data": "modified"
                    },
                    {
                        "data": null,
                        "fnCreatedCell": (nTd, sData, oData, iRow, iCol) => {
                            var form = $(
                                `<form class="remove-item-form" method="POST" action="/admin/items/${oData.id}/remove">
                                    @method('DELETE')
                                    ${csrf}
                                    <button type="submit" style="font-size: 11px;"><i class="fa fa-trash" style="color: #A52A25;"></i></button>
                                </form>`
                            );

                            $(nTd).html(form);

                            form.on('submit', function(e) {
                                if (!confirm(
                                        '¿Estás seguro que deseas eliminar este articulo?'
                                        )) {
                                    e.preventDefault();
                                }
                            })
                        }
                    },
                ]
            });
        });
    </script>

@endsection
