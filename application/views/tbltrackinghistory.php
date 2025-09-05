<table class="table table-bordered table-hover" id="tbltrackinghistory">

    <thead>

        <tr class="text-center">

            <th>ESN</th>

            <th>ESN NAME</th>

            <th>Latitude</th>

            <th>Longitude</th>

            <th>Distance (NM)</th>

            <th>Speed Knot (NMph)</th>

            <th>Timestamp</th>

        </tr>

    </thead>

    <tbody>

        <?php
        $sum_distance = 0;

        foreach ($data as $key => $history): ?>

            <tr class="text-center">

                <td><?= output($history['esn']); ?></td>

                <td><?= output($history['esnName']); ?></td>

                <td><?= output(number_format($history['latitude'], 5)); ?></td>

                <td><?= output(number_format($history['longitude'], 5)); ?></td>

                <td><?= !empty($history['distance']) ? output(number_format($history['distance'], 5)) : 0; ?></td>

                <td><?= !empty($history['speed']) ? output(number_format($history['speed'], 5)) : 0; ?></td>

                <td><?= output($history['timestamp']); ?></td>
            </tr>
            <?php
            !empty($history['distance']) ? $sum_distance = $sum_distance + $history['distance'] : "" ?>
        <?php endforeach; ?>

    </tbody>

    <tfoot>
        <tr class="text-center">
            <th colspan="4" style="text-align:right;">Total Distance (NM):</th>
            <th><?= output(number_format($sum_distance, 5)) ?> </th>
        </tr>
    </tfoot>


</table>

<script>
    $('#tbltrackinghistory').DataTable({

        "paging": true,

        "lengthChange": false,

        "ordering": false,

        "info": true,

        "autoWidth": false,

        "responsive": true,

        "scrollX": true,

        "pageLength": 5,

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

        buttons: [
            'excelHtml5' // This adds the Excel export button
        ],

        dom: 'Bfrtip' // This is CRUCIAL for buttons to render

    });
</script>