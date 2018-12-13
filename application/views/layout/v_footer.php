<?php
$nama_lembaga = $this->config->item("nama_lembaga"); $logo_lembaga = $this->config->item("logo_lembaga");
$css_lembaga = $this->config->item("css_lembaga"); $warna_lembaga = $this->config->item("warna_lembaga");
if (sizeof($data_lembaga)>0) {
    $nama_lembaga = $data_lembaga[0]["nama"];
    $logo_lembaga = $data_lembaga[0]["logo"];
    $css_lembaga = $data_lembaga[0]["css"];
    $warna_lembaga = $data_lembaga[0]["warna"];
}
?>

            <!-- Footer -->

            <div class="footer fixed">
                <div>
                    <strong>Copyright</strong> <?php echo $nama_lembaga; ?> &copy; 2018
                </div>

            </div>

            <!-- /footer -->

        </div>

        <!-- Mainly scripts -->
        <script src="<?php echo base_url();?>assets/js/jquery-3.1.1.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
        <script src="<?php echo base_url();?>assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>


      <!-- jquery UI -->
<!--        <script src="--><?php //echo base_url();?><!--assets/js/plugins/jquery-ui/jquery-ui.min.js"></script>-->

        <!-- Custom and plugin javascript -->
        <script src="<?php echo base_url();?>assets/js/inspinia.js"></script>
        <script src="<?php echo base_url();?>assets/js/plugins/pace/pace.min.js"></script>


        <!-- Chosen -->
        <script src="<?php echo base_url();?>assets/js/plugins/chosen/chosen.jquery.js"></script>

        <!-- Select 2 -->
        <script src="<?php echo base_url();?>assets/js/plugins/select2/select2.full.min.js"></script>

        <!-- Date picker -->
        <script src="<?php echo base_url();?>assets/js/plugins/datapicker/bootstrap-datepicker.js"></script>

        <!-- iCheck -->
        <script src="<?php echo base_url();?>assets/js/plugins/iCheck/icheck.min.js"></script>

        <!-- Typehead -->
        <script src="<?php echo base_url();?>assets/js/plugins/typehead/bootstrap3-typeahead.min.js"></script>

        <!-- DataTable -->
        <script src="<?php echo base_url();?>assets/js/plugins/dataTables/datatables.min.js"></script>

        <!-- Sweet alert -->
        <script src="<?php echo base_url();?>assets/js/plugins/sweetalert/sweetalert.min.js"></script>

        <!-- Jquery Validate -->
        <script src="<?php echo base_url();?>assets/js/plugins/validate/jquery.validate.min.js"></script>

        <!-- blueimp gallery -->
        <script src="<?php echo base_url();?>assets/js/plugins/blueimp/jquery.blueimp-gallery.min.js"></script>

        <!-- slick carousel -->
        <script src="<?php echo base_url();?>assets/js/plugins/slick/slick.min.js"></script>

        <!-- Full Calendar -->
        <script src="<?php echo base_url();?>assets/js/plugins/fullcalendar/moment.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/plugins/fullcalendar/fullcalendar.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/plugins/fullcalendar/id.js"></script>


        <!-- Ladda -->
        <script src="<?php echo base_url();?>assets/js/plugins/ladda/spin.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/plugins/ladda/ladda.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/plugins/ladda/ladda.jquery.min.js"></script>

        <script src="<?php echo base_url();?>assets/js/custom.js"></script>

        <?php
        if (isset($jskereta_to_load)){
            ?>
            <script src="<?php echo base_url();?>assets/js/<?=$jskereta_to_load;?>"></script>
            <?php
        }else if (isset($jspulsa_to_load)){
            ?>
            <script src="<?php echo base_url();?>assets/js/<?=$jspulsa_to_load;?>"></script>
            <?php
        }else if (isset($jsppob_to_load)){
            ?>
            <script src="<?php echo base_url();?>assets/js/<?=$jsppob_to_load;?>"></script>
            <?php
        }
        else if (isset($jsuser_to_load)){
            ?>
            <script src="<?php echo base_url();?>assets/js/<?=$jsuser_to_load;?>"></script>
            <?php
        }
        else if (isset($jspesawat_to_load)) {
            ?>
            <script src="<?php echo base_url(); ?>assets/js/<?=$jspesawat_to_load;?>"></script>
            <?php
        }
        else if (isset($jshotel_to_load)) {
            ?>
            <script src="<?php echo base_url(); ?>assets/js/<?=$jshotel_to_load;?>"></script>
            <?php
        }
        else if (isset($jstopup_to_load)) {
            ?>
            <script src="<?php echo base_url(); ?>assets/js/<?=$jstopup_to_load;?>"></script>
            <?php
        }
        else if (isset($jsdeposit_to_load)) {
            ?>
            <script src="<?php echo base_url(); ?>assets/js/<?=$jsdeposit_to_load;?>"></script>
            <?php
        }
        else if (isset($jsmutasideposit_to_load)){
            ?>
            <script src="<?php echo base_url();?>assets/js/<?=$jsmutasideposit_to_load;?>"></script>
            <?php
        }
        else if (isset($jscheckout_to_load)){
            ?>
            <script src="<?php echo base_url();?>assets/js/<?=$jscheckout_to_load;?>"></script>
            <?php
        }
        else if (isset($jstransaksi_to_load)){
            ?>
            <script src="<?php echo base_url();?>assets/js/<?=$jstransaksi_to_load;?>"></script>
            <?php
        }
        else if (isset($jsfiltertransaksi_to_load)){
            ?>
            <script src="<?php echo base_url();?>assets/js/<?=$jsfiltertransaksi_to_load;?>"></script>
            <?php
        }
        else if (isset($js_to_load)){
            ?>
            <script src="<?php echo base_url();?>assets/js/<?=$js_to_load;?>"></script>
            <?php
        }
        ?>

        <script>
            $('body.canvas-menu .sidebar-collapse').slimScroll({
                height: '100%',
                railOpacity: 0.9
            });
        </script>

    </body>

</html>