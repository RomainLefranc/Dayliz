$(document).ready(function() {
    $('#dataTableUser').dataTable({
        processing: true,
        serverSide: true,
        responsive:true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/French.json"
        },
        ajax: "{{ route('users.list') }}",
        lengthMenu: [
            [10, 25, 50, -1],
            ['10', '25', '50', 'Tout montrer']
        ],
        columns:[
            {data:'lastName',name:'Nom'},
            {data: 'firstName',name:'Prénom'},
            {data:'role',name:'Rôle'},
            {data:'promotion',name:'Promotion',orderable:false},
            {data: 'modifier', name:'modifier', orderable:false, searchable:false},
            {data:'generate',name:'generate', orderable:false, searchable:false},
            {data:'activate',name:'activate', orderable:false, searchable:false}
        ]
    });

    $('#dataTableActivities').dataTable({
        processing: false,
        serverSide: false,
        responsive:true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.22/i18n/French.json"
        },
        ajax: `{{ route('activities.list') }}`,
        lengthMenu: [
            [10, 25, 50, -1],
            ['10', '25', '50', 'Tout montrer']
        ],
        columns:[
            {data:'title',name:'Nom'},
            {data: 'beginAt',name:'Début'},
            {data:'endAt',name:'Fin'},
            {data: 'modifier', name:'modifier', orderable:false, searchable:false}
        ]
    });




})