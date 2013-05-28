<?php
class listTitoli {
    //put your code here
}

?>
<!--
<p class="no-margine">
    <a href="/haveasync/web/backend_dev.php/it/titles/downloadexcel">Download as Excel</a>
</p>
-->
<div id="search-form">

    <form action="index.php?page=titoli/listTitoli" method="post">
        <fieldset>
            <label for="search-title">Titolo: </label>
            <input name="search-title" id="search-title" type="text" value="<?php echo array_key_exists('search-title', $_POST)?$_POST['search-title']:""; ?>">
            <label for="search-isrc">Isrc: </label>
            <input name="search-isrc" id="search-isrc" type="text" value="<?php echo array_key_exists('search-isrc', $_POST)?$_POST['search-isrc']:""; ?>">
            <input id="search-button" value="Search" type="submit">
        </fieldset>
    </form>
</div>

<div style="width: 998px;" dir="ltr" id="gbox_results_grid" class="ui-jqgrid ui-widget ui-widget-content ui-corner-all">
   <!-- <div class="ui-widget-overlay jqgrid-overlay" id="lui_results_grid"></div>
    <div class="loading ui-state-default ui-state-active" id="load_results_grid">Caricamento...</div>-->
    <div style="width: 998px;" id="gview_results_grid" class="ui-jqgrid-view">
        <div style="display: none;" class="ui-jqgrid-titlebar ui-widget-header ui-corner-top ui-helper-clearfix">
            <span class="ui-jqgrid-title"></span>
        </div>
       <div class="ui-state-default ui-jqgrid-hdiv" style="width: 998px;">
            <div class="ui-jqgrid-hbox">
                <table class="ui-jqgrid-htable" style="width:998px" role="grid" aria-labelledby="gbox_results_grid" border="0" cellpadding="0" cellspacing="0">
                    <thead>
                        <tr class="ui-jqgrid-labels" role="rowheader">
                            <th style="width: 380px;" id="results_grid_Brano" role="columnheader" class="ui-state-default ui-th-column ui-th-ltr">
                                <span style="cursor: col-resize;" class="ui-jqgrid-resize ui-jqgrid-resize-ltr">&nbsp;</span>
                    <div class="ui-jqgrid-sortable" id="jqgh_Brano">Brano<span class="s-ico" style="">
                            <span sort="asc" class="ui-grid-ico-sort ui-icon-asc ui-state-disabled ui-icon ui-icon-triangle-1-n ui-sort-ltr"></span>
                            <span sort="desc" class="ui-grid-ico-sort ui-icon-desc ui-icon ui-icon-triangle-1-s ui-sort-ltr"></span>
                            
                        </span>
                    </div>
                </th>
                <th style="width: 136px;" id="results_grid_TipoProdTitoli" role="columnheader" class="ui-state-default ui-th-column ui-th-ltr">
                    <span style="cursor: col-resize;" class="ui-jqgrid-resize ui-jqgrid-resize-ltr">&nbsp;</span>
                <div class="ui-jqgrid-sortable" id="jqgh_TipoProdTitoli">Versione<span class="s-ico" style="display:none">
                        <span sort="asc" class="ui-grid-ico-sort ui-icon-asc ui-state-disabled ui-icon ui-icon-triangle-1-n ui-sort-ltr"></span>
                        <span sort="desc" class="ui-grid-ico-sort ui-icon-desc ui-state-disabled ui-icon ui-icon-triangle-1-s ui-sort-ltr"></span>
                        
                    </span>
                </div>
                </th>
                <th style="width: 380px;" id="results_grid_Esecutore" role="columnheader" class="ui-state-default ui-th-column ui-th-ltr">
                    <span style="cursor: col-resize;" class="ui-jqgrid-resize ui-jqgrid-resize-ltr">&nbsp;</span>
                <div class="ui-jqgrid-sortable" id="jqgh_Esecutore">Artista<span class="s-ico" style="display:none">
                        <span sort="asc" class="ui-grid-ico-sort ui-icon-asc ui-state-disabled ui-icon ui-icon-triangle-1-n ui-sort-ltr"></span>
                        <span sort="desc" class="ui-grid-ico-sort ui-icon-desc ui-state-disabled ui-icon ui-icon-triangle-1-s ui-sort-ltr">
                            
                        </span>
                        
                    </span>
                </div></th>
                <th style="width: 82px;" id="results_grid_Durata" role="columnheader" class="ui-state-default ui-th-column ui-th-ltr">
                <div class="ui-jqgrid-sortable" id="jqgh_Durata">Durata<span class="s-ico" style="display:none">
                        <span sort="asc" class="ui-grid-ico-sort ui-icon-asc ui-state-disabled ui-icon ui-icon-triangle-1-n ui-sort-ltr"></span>
                        <span sort="desc" class="ui-grid-ico-sort ui-icon-desc ui-state-disabled ui-icon ui-icon-triangle-1-s ui-sort-ltr"></span>
                        
                    </span>
                </div>
                </th>
                </tr>
                </thead>
                </table>
            </div>
        </div>
        <div style="width: 998px;" class="ui-jqgrid-bdiv">
            <div><div></div>
                <table style="width: 998px;" class="ui-jqgrid-btable" aria-labelledby="gbox_results_grid" aria-multiselectable="false" role="grid" id="results_grid" border="0" cellpadding="0" cellspacing="0">
                    <tbody>
                        <tr class="jqgfirstrow" role="row" >
                            <td role="gridcell" style="height:0px;width:380px;"></td>
                            <td role="gridcell" style="height:0px;width:136px;"></td>
                            <td role="gridcell" style="height:0px;width:380px;"></td>
                            <td role="gridcell" style="height:0px;width:82px;"></td>
                        </tr>
                         <?php foreach ($result as $titolo): ?>
                        <tr id="<?php echo $titolo->getId();?>" role="row" class="ui-widget-content jqgrow ui-row-ltr">
                            <td  title="<?php echo $titolo->getBrano();?>" ><?php echo $titolo->getBrano();?></td>
                            <td  title="<?php echo $titolo->getTipoProdTitoli();?>" ><?php echo $titolo->getTipoProdTitoli();?></td>
                            <td  title="<?php echo $titolo->getEsecutore();?>" ><?php echo $titolo->getEsecutore();?></td>
                            <td  title="<?php echo $titolo->getEsecutore();?>" ><?php echo $titolo->getDurataMin()."' ".$titolo->getDurataSec()."''";?></td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="ui-jqgrid-resize-mark" id="rs_mresults_grid">&nbsp;</div>
    <div dir="ltr" class="ui-state-default ui-jqgrid-pager ui-corner-bottom" style="width: 998px;" id="pager">
        <div id="pg_pager" class="ui-pager-control" role="group">
                                           <!-- <select name=="perPage">
                                                <option role="option" value="15" selected="selected">15</option>
                                                <option role="option" value="30">30</option>
                                                <option role="option" value="45">45</option>
                                            </select>-->
            <?php echo $linkPager['all']; ?>
        </div>
        
    </div>
    
</div>
<script>
    jQuery(document).ready(function(){
        jQuery(".ui-jqgrid-btable .ui-widget-content").hover(function() {
        if(jQuery(this).css('background-color') === 'rgb(184, 184, 184)') {
            jQuery(this).css('background-color','gray');
        }else{
            jQuery(this).css('background-color','rgb(184, 184, 184)');
        }
        });
       jQuery(".ui-jqgrid-btable .ui-widget-content").click(function() {
   
        window.location.href = "index.php?page=titoli/addTitoli&id="+jQuery(this).attr('id')+"<?php echo array_key_exists('pageID', $_GET)?'&pageID='.$_GET['pageID']:"";?>";
        });
        jQuery("perPage").change(function() {
         window.location.href = "index.php?page=titoli/listTitoli&perPage="+jQuery(this).attr("id");
        });
    });

</script>




<!--<div class="classnewtitle ui-state-default ui-corner-bottom">
    <span class="ui-icon ui-icon-arrow-4-diag"></span>
    <a href="/haveasync/web/backend_dev.php/it/titles/new">New Title</a>
</div>-->


