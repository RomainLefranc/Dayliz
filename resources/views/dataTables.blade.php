<script>
    $(document).ready(function() {
        $('#dataTableUser').dataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/French.json"
            },
            ajax: "{{ route('users.list') }}",
            lengthMenu: [
                [10, 25, 50, -1],
                ['10', '25', '50', 'Tout montrer']
            ],
            columns: [{
                    data: 'lastName',
                    name: 'Nom'
                },
                {
                    data: 'firstName',
                    name: 'Prénom'
                },
                {
                    data: 'role',
                    name: 'Rôle'
                },
                {
                    data: 'promotion',
                    name: 'Promotion',
                    orderable: false
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });
        $('#dataTableActivities').dataTable({
            processing: false,
            serverSide: false,
            responsive: true,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/French.json"
            },
            ajax: `{{ route('activities.list', $examen->id) }}`,
            lengthMenu: [
                [10, 25, 50, -1],
                ['10', '25', '50', 'Tout montrer']
            ],
            columns: [{
                    data: 'title',
                    name: 'Nom'
                },
                {
                    data: 'duree',
                    name: 'Début'
                },
                {
                    data:'description',
                    name:'Description',
                    orderable : false,
                    searchable : false
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },

            ]
        });


    })
</script>