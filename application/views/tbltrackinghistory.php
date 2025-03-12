<table class="table table-bordered table-hover" id="tbltrackinghistory">

    <thead>

        <tr class="text-center">

            <th style="width: 10%">ESN</th>

            <th style="width: 10%">ESN NAME</th>

            <th style="width: 10%">Latitude</th>

            <th style="width: 15%">Longitude</th>

            <th style="width: 15%">Timestamp</th>

        </tr>

    </thead>

    <tbody>

        <?php foreach ($data as $key => $history): ?>

            <tr class="text-center">

                <td><?= output($history['esn']); ?></td>

                <td><?= output($history['esnName']); ?></td>

                <td><?= output(number_format($history['latitude'], 5)); ?></td>

                <td><?= output(number_format($history['longitude'], 5)); ?></td>

                <td><?= output($history['timestamp']); ?></td>

            </tr>

        <?php endforeach; ?>

    </tbody>

</table>

<script>
    $('#tbltrackinghistory').DataTable({

        "paging": true,

        "lengthChange": false,

        "ordering": false,

        "info": false,

        "autoWidth": false,

        "responsive": true,

        "pageLength": 10,

        language: {

            search: "ค้นหา :",

            searchPlaceholder: "ค้นหาข้อมูลในตาราง",

            "lengthMenu": "แสดง _MENU_ รายการ/หน้า",

            "zeroRecords": "--ไม่มีข้อมูล--",

            "paginate": {

                "first": "<<",

                "last": ">>",

                "next": ">",

                "previous": "<"

            },

            "info": "แสดง _START_ ถึง _END_ จาก _TOTAL_ รายการ",

        },

    });
</script>