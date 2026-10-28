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
                            @php
                                $fields = ['ID', 'Nombre', 'Articulos (Publicados)', 'Publicada', 'Acciones'];
                            @endphp
                            <tr>
                                {{-- <th>{{implode('</th><th>', $fields)}}</th> --}}
                                @foreach ($fields as $field)
                                    <th>{{ $field }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                @foreach ($fields as $field)
                                    <th>{{ $field }}</th>
                                @endforeach
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
                "ajax": "<?php echo url('/admin/tags/all'); ?>",
                "order": [
                    [0, "desc"] //Filtrar por id desc
                ],
                "columns": [{
                        "data": "id"
                    },
                    {
                        "data": "name",
                        //TODO: crear vista para editar nombre de la edicion
                        // "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                        //     $(nTd).html(`<a href="/admin/items/${oData.id}">${oData.name}</a>`);
                        // }
                    },
                    {
                        "data": "articles_count",
                        // "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                        //     $(nTd).html(`<a href="/admin/items/${oData.id}">${oData.name}</a>`);
                        // }
                    },
                    {
                        "data": "published",
                        "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                            let icon = "<i class='fa fa-times-circle' style='color: #A52A25;'></i>";

                            if (oData.published == '1') {
                                icon = "<i class='fa fa-check' style='color: #3E843E;'></i>"
                            }

                            $(nTd).html(`<form action='/admin/tags/${oData.id}/update/published' method='post'>
                                ${csrf}
                                <button type='submit' style='font-size: 11px;'>${icon}</form>`);

                        }
                    },
                    {
                        "data": null,
                        "fnCreatedCell": (nTd, sData, oData, iRow, iCol) => {
                            var form = $(
                                `<form class="remove-item-form" method="POST" action="/admin/tags/${oData.id}/remove">
                                    @method('DELETE')
                                    ${csrf}
                                    <button type="submit" style="font-size: 11px;"><i class="fa fa-trash" style="color: #A52A25;"></i></button>
                                </form>`
                            );

                            $(nTd).html(form);

                            form.on('submit', function(e) {
                                if (!confirm(
                                        '¿Estás seguro que deseas eliminar esta edición?'
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
