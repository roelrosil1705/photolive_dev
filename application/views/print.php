<script type="text/javascript">

    function printThis(){
        // Suppress print dialog
        jsPrintSetup.setSilentPrint(true);
        // Do Print
         window.focus();
        jsPrintSetup.print();
        // window.print();
//        window.location = "<?php //echo base_url('/shared/')?>//";
        //alert('boom');
        window.close();
    }</script>
<body onload='printThis()' style="margin:0px;">
<?php
$dir = 'assets/uploaded/';
$folder = scandir($dir,1);
foreach($folder as $img) {
    if(is_file($dir.$img) && $img != 'Thumbs.db') {
//        $data['photo'] = $img;
//
        echo '<img src="'.base_url($dir.$img).'">';
        break;
    }
}
?>
</body>