<?php
if($_POST){
    $bahadir->SLAYT_EKLE();
}
?>

<link href="/panel/pages/slaytlar/css.css" rel="stylesheet" />
<script src="/panel/pages/slaytlar/js.js"></script>

<div class="container">
    <div class="card">
        <div class="action-header clearfix">
            <div class="ah-label hidden-xs">
                <?php echo $bahadir->TRANSLATE_WORD("slayt arayın", 1); ?>
            </div>
            <div class="ah-search">
                <input type="text" placeholder="<?php echo $bahadir->TRANSLATE_WORD("aranacak kelime", 1); ?>" class="ahs-input" />
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
        <div class="card-body">
            <div id="sortable" class="lightbox photos clearfix">
                <?php
                $SLAYTLAR = $bahadir->mssqlDb->Select("SELECT *FROM SLIDER ORDER BY SEQUENCE ASC");
                foreach ($SLAYTLAR as $SLAYT)
                {
                ?>
                <div sira="<?php echo $SLAYT["SEQUENCE"]; ?>" data-id="<?php echo $SLAYT["ID"]; ?>" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ui-state-default draggable">
                    <div class="lightbox-item p-item" style="cursor:move;">
                        <img src="/panel/system/ViewBinaryImage.php?OPTION=SLIDER&ID=<?php echo $SLAYT["ID"]; ?>" alt="<?php echo $SLAYT["TITLE1"]; ?>" />
                    </div>
                    <br />
                    <div style="z-index:9999;">
                        <div style="float:left;margin-bottom:5px;margin-left:5px;">
                            <button class="btn bgm-bluegray  waves-effect">
                                <i class="zmdi zmdi-edit"></i>
                                <span>
                                    <?php echo $bahadir->TRANSLATE_WORD("düzenle", 1); ?>
                                </span>
                            </button>
                        </div>
                        <div style="float:right;margin-right:10px;">
                            <div hidden-input-id="<?php echo $SLAYT["ID"]; ?>" class="toggle-switch" data-ts-color="blue">
                                <label for="ts<?php echo $SLAYT["ID"]; ?>" class="ts-label">Görünürlük</label>
                                <input id="ts<?php echo $SLAYT["ID"]; ?>" type="checkbox" hidden="hidden" value="<?php echo $SLAYT["VISIBILITY"]; ?>" />
                                <label for="ts<?php echo $SLAYT["ID"]; ?>" class="ts-helper"></label>
                            </div>
                        </div>
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
                            <label>Slayt Resmi Formatı</label>
                            <div class="radio m-b-15">
                                <label>
                                    <input type="radio" name="slayt_formati" value="svg_kodu" valuem="1" />
                                    <i class="input-helper"></i>SVG Kodu
                                </label>
                            </div>
                            <div class="radio m-b-15">
                                <label>
                                    <input type="radio" name="slayt_formati" value="resim_dosyasi" valuem="0" />
                                    <i class="input-helper"></i>Resim Dosyası
                                </label>
                            </div>
                        </div>
                        <div class="form-group" id="div_slayt_resmi">
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
                        <div class="form-group" id="div_svg_kodu">
                            <label>Svg Kodu</label>
                            <textarea name="txtSvgKodu" rows="5" class="form-control"></textarea>
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

