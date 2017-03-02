
<div class="container container-alt">
    <div class="block-header">
        <h2>
            <?php echo $bahadir->TRANSLATE_WORD("slaytlar", 1); ?>
            <small>
                <?php echo $bahadir->TRANSLATE_WORD("slaytları yönetin", 1); ?>
            </small>
        </h2>
    </div>
    <div class="card">
        <div class="action-header clearfix">
            <div class="ah-label hidden-xs">
                <?php echo $bahadir->TRANSLATE_WORD("slayt arayın", 1); ?>
            </div>
            <div class="ah-search">
                <input type="text" placeholder=" <?php echo $bahadir->TRANSLATE_WORD("aranacak kelime", 1); ?>" class="ahs-input" />
                <i class="ahs-close" data-ma-action="action-header-close">&times;</i>
            </div>
            <ul class="actions">
                <li>
                    <a href="#" data-ma-action="action-header-open" title="">
                        <i class="zmdi zmdi-search"></i>
                    </a>
                </li>
                <li>
                    <button id="btnSlaytEkle" type="button" href="#" title="<?php echo $bahadir->TRANSLATE_WORD("yeni slayt ekle", 1); ?>">
                        <i class="zmdi zmdi-plus-square"></i>
                    </button>
                </li>
                <li>
                    <a href="#" title="<?php echo $bahadir->TRANSLATE_WORD("ayarlar", 1); ?>">
                        <i class="zmdi zmdi-settings"></i>
                    </a>
                </li>
            </ul>
        </div>


        <div class="card-body card-padding">
            <div class="lightbox photos clearfix">

                <?php
                $SLAYTLAR = $bahadir->mssqlDb->Select("SELECT *FROM SLIDER ORDER BY ID DESC");
                foreach ($SLAYTLAR as $SLAYT)
                {
                ?>

                <div data-src="/uploads/slider/<?php echo $SLAYT["IMG_PATH_SM"]; ?>" class="col-md-4 col-sm-4 col-xs-6">
                    <div class="lightbox-item p-item">
                        <img src="/uploads/slider/<?php echo $SLAYT["IMG_PATH_SM"]; ?>" alt="<?php echo $SLAYT["TITLE1"]; ?>" />
                    </div>
                </div>

                <?php
                }
                ?>

            </div>

            <div class="clearfix"></div>
            <div class="load-more m-t-30">
                <a href="">
                    <i class="zmdi zmdi-refresh-alt"></i>Load More...
                </a>
            </div>
        </div>

    </div>
</div>


<script>
    $(document).ready(function () {
        $("#btnSlaytEkle").click(function () {   });
    });
</script>

<div class="btn-demo" id="btn-color-targets">
    <a href="#modalColor" data-target-color="blue" data-toggle="modal" class="btn bgm-blue">Blue</a>
    <a href="#modalColor" data-target-color="lightblue" data-toggle="modal"
        class="btn bgm-lightblue">
        Light Blue
    </a>
    <a href="#modalColor" data-target-color="cyan" data-toggle="modal" class="btn bgm-cyan">Cyan</a>
    <a href="#modalColor" data-target-color="green" data-toggle="modal"
        class="btn bgm-green">
        Green
    </a>
    <a href="#modalColor" data-target-color="lightgreen" data-toggle="modal"
        class="btn bgm-lightgreen">
        Light Green
    </a>
    <a href="#modalColor" data-target-color="red" data-toggle="modal" class="btn bgm-red">Red</a>
    <a href="#modalColor" data-target-color="amber" data-toggle="modal"
        class="btn bgm-amber">
        Amber
    </a>
    <a href="#modalColor" data-target-color="orange" data-toggle="modal"
        class="btn bgm-orange">
        Orange
    </a>
    <a href="#modalColor" data-target-color="teal" data-toggle="modal" class="btn bgm-teal">Teal</a>
    <a href="#modalColor" data-target-color="bluegray" data-toggle="modal"
        class="btn bgm-bluegray">
        Blue Gray
    </a>
</div>


<div class="modal fade" data-modal-color="" id="modalColor" data-backdrop="static"
    data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modal title</h4>
            </div>
            <div class="modal-body">
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sodales
                    orci ante, sed ornare eros vestibulum ut. Ut accumsan vitae eros sit
                    amet tristique. Nullam scelerisque nunc enim, non dignissim nibh
                    faucibus ullamcorper. Fusce pulvinar libero vel ligula iaculis
                    ullamcorper. Integer dapibus, mi ac tempor varius, purus nibh mattis
                    erat, vitae porta nunc nisi non tellus. Vivamus mollis ante non massa
                    egestas fringilla. Vestibulum egestas consectetur nunc at ultricies.
                    Morbi quis consectetur nunc.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link">Save changes</button>
                <button type="button" class="btn btn-link" data-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

<script src="/panel/assets/plugins/bootstrap-growl/bootstrap-growl.min.js"></script>
<script src="/panel/assets/plugins/bower_components/Waves/dist/waves.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('body').on('click', '#btn-color-targets > .btn', function(){
            var color = $(this).data('data-target-color');
            $('#modalColor').attr('data-modal-color', color);
        });
    });
</script>
