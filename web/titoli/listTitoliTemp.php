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

 <div id="searchPanel">

<div id="search-form">

    <form action="index.php?page=titoli/listTitoli" method="post">
        <fieldset>
            <label for="search-title">Titolo: </label>
            <input name="search-title" id="search-title" type="text">
            <label for="search-isrc">Isrc: </label>
            <input name="search-isrc" id="search-isrc" type="text" ><br>
            <input id="search-button" value="Search" type="submit" class="button">
        </fieldset>
    </form>
</div>


      
     
            
			<div></div>
			<div>
                <table cellpadding=5 cellspacing=5 style="width: 380px;position:relative; left:15px; " class="ui-jqgrid-btable" aria-labelledby="gbox_results_grid" aria-multiselectable="false" role="grid" id="results_grid" border="0" cellpadding="0" cellspacing="0" >
                    <tbody>
                        
                         <?php foreach ($result as $titolo): ?>
                        <tr id="<?php echo $titolo->getId();?>" role="row" class="ui-widget-content">
                            <td  class="titoliColor" valign="top" title="<?php echo $titolo->getBrano();?>" ><?php echo $titolo->getBrano();?></td>
							 <td  class="small" valign="top" title="<?php echo $titolo->getEsecutore();?>" ><?php echo $titolo->getEsecutore();?></td>
                            <td  NOWRAP class="small" valign="top" title="<?php echo $titolo->getISRC();?>" ><?php echo $titolo->getISRC();?></td>
                            <td  NOWRAP class="small" valign="top" title="<?php echo $titolo->getDurata();?>" ><?php echo $titolo->getDurataMin()."' ".$titolo->getDurataSec()."''";?></td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
   

    <div>&nbsp;</div>
    <div class="paginatore">
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
            jQuery(this).css('background-color','white');
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



</div>


<!--<div class="classnewtitle ui-state-default ui-corner-bottom">
    <span class="ui-icon ui-icon-arrow-4-diag"></span>
    <a href="/haveasync/web/backend_dev.php/it/titles/new">New Title</a>
</div>-->


