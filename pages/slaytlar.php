<?php
if($_POST){
    $bahadir->SLAYT_EKLE();
}
?>
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
                    <a id="btnSlaytEkle" href="#" title="<?php echo $bahadir->TRANSLATE_WORD("yeni slayt ekle", 1); ?>">
                        <i class="zmdi zmdi-plus-square"></i>
                    </a>
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
                <div data-src="/uploads/images/slayt/<?php echo $SLAYT["IMG_SM"]; ?>" class="col-md-4 col-sm-4 col-xs-6">
                    <div class="lightbox-item p-item">
                        <img src="/uploads/images/slayt/<?php echo $SLAYT["IMG_SM"]; ?>" alt="<?php echo $SLAYT["TITLE1"]; ?>" />
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

<div class="modal fade" id="modalWider" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title">Slayt</h4>
                </div>
                <div class="modal-body">

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>1. Başlık</label>
                            <input type="text" name="baslik1" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>2. Başlık</label>
                            <input type="text" name="baslik2" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Kısa Açıklama</label>
                            <input type="text" name="aciklama" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Slayt Resmi</label>
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width:783px !important; height:193px !important; background-color:#f2f2f2;background-size:cover;"></div>
                                <div>
                                    <span class="btn btn-info btn-file">
                                        <span class="fileinput-new">Resim Seç</span>
                                        <input type="file" name="resim" accept="image/*" />
                                    </span>
                                    <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Sil</a>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>İçerik</label>
                            <textarea name="content" class="html-editor"></textarea>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button id="btnSlaytKaydet" type="submit" class="btn btn-link waves-effect">Kaydet</button>
                    <button id="btnSlaytGuncelle" type="submit" class="btn btn-link waves-effect">Güncelle</button>
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">
                        Kapat
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        $("#btnSlaytEkle").click(function () {
            $("#modalWider").modal("show");
        });

        $("#btnSlaytKaydet").click(function () {

        });

        $("#btnSlaytGuncelle").click(function () {

        });
    });
</script>