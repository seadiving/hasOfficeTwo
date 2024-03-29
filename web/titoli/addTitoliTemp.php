<?php
require_once '../json/Generi.php';

function error_field($title, array $errors) {
    foreach ($errors as $error) {
        /* @var $error Error */
        if ($error->getSource() == $title) {
            return ' error-field';
        }
    }
    return '';
}

?>
<!--<p>
    <a href="/haveasync/web/backend_dev.php/it/titles/downloadexcel">Download as Excel</a>
</p>-->
<h1>
    
    <?//php if ($edit): ?>
       Modifica
    <?//php else: ?>
        <!--Add new TITOLO-->
    <?//php endif; ?>
</h1>
      

<?php if (!empty($errors)): ?>
<ul class="errors">
    <?php foreach ($errors as $error): ?>
        <?php /* @var $error Error */ ?>
        <li><?php echo $error->getMessage(); ?></li>
    <?php endforeach; ?>
</ul>
<?php endif; ?>
      <form action="index.php?page=titoli/addTitoli" method="post">
    <fieldset>
        <div class="field">
            <label>Brano</label>
            <input type="text" name="titoli[brano]" value="<?php echo Utils::escape($titoli->getBrano()); ?>"
                   class="text<?php echo error_field('brano', $errors); ?>"/>
        </div>
        <div class="field">
            <label>Autore</label>
            <input type="text" name="titoli[autore]" value="<?php echo Utils::escape($titoli->getAutore()); ?>"
                   class="text<?php echo error_field('autore', $errors); ?>" />
        </div> 
        <div class="field">
            <label>Artista</label>
            <input type="text" name="titoli[esecutore]" value="<?php echo Utils::escape($titoli->getEsecutore()); ?>"
                   class="text<?php echo error_field('esecutore', $errors); ?>" />
        </div>             
        <div class="field">
            <label>Editore</label>
            <input type="text" name="titoli[editore]" value="<?php echo Utils::escape($titoli->getEditore()); ?>"
                   class="text<?php echo error_field('editore', $errors); ?>" />
        </div>
        <div class="field">
            <label>Anno</label>
            <input type="text" name="titoli[anno]" value="<?php echo Utils::escape($titoli->getAnno()); ?>"
                   class="text<?php echo error_field('anno', $errors); ?>" />
        </div> 
        <div class="field">
            <label>ISRC</label>
            <input type="text" name="titoli[ISRC]" value="<?php echo Utils::escape($titoli->getISRC()); ?>"
                   class="text<?php echo error_field('ISRC', $errors); ?>" />
        </div> 
        <div class="field">    
            <label>Produzioni casa</label>
            <select name="titoli[sProduzioniCasa]">
                <?php foreach($etichette as $etichetta){?>
                    <option value="<?php echo $etichetta->getId()?>-<?php echo $etichetta->getCodice()?>" <?php if($etichetta->getId() == $titoli->getProduzioniCasaId()) echo "selected"?>><?php echo $etichetta->getNome()?></option>
                <?php }?>
             </select>
        </div>
        <div class="field">
            <label>Version</label>
            <input type="text" name="titoli[tipo_prod_titoli]" value="<?php echo Utils::escape($titoli->getTipoProdTitoli()); ?>"
                   class="text<?php echo error_field('tipo_prod_titoli', $errors); ?>" />
        </div>
         <div class="field">
               <label>Durata</label>
               <input name="titoli[minuti]" value="<?php echo $titoli->getDurataMin();?>" type="text" size="3" maxlength="3" id="titoli_durata_minuti" />'&nbsp;<input name="titoli[secondi]" value="<?php echo $titoli->getDurataSec();?>" type="text" size="2" maxlength="2"  id="titoli_durata_secondi" />''        
          </div> 
         <div class="field">
            <label>Compositore</label>
            <input type="text" name="titoli[compositore]" value="<?php echo Utils::escape($titoli->getCompositore()); ?>"
                   class="text<?php echo error_field('compositore', $errors); ?>" />
        </div>
        <div class="field ui-widget">    
            <label>Genere</label>
                <input type="text" id="genere" name="titoli[genere]" value="<?php echo Utils::escape($titoli->getGenere()); ?>"
                   class="text<?php echo error_field('genere', $errors); ?>" />
        </div>
        <div class="field ui-widget">
            <label>SubGenere</label>
                <input type="text" id="subgenere" name="titoli[subgenere]" value="<?php echo Utils::escape($titoli->getSubGenere()); ?>"
                   class="text<?php echo error_field('subgenere', $errors); ?>" />
        </div>
         <div class="field">
            <label>Proprieta master</label>
            <input type="text" name="titoli[proprieta_master]" value="<?php echo Utils::escape($titoli->getProprietaMaster()); ?>"
                   class="text<?php echo error_field('proprieta_master', $errors); ?>" />
        </div>
        <div class="field">
            <label>Descrizione</label>
            <textarea rows="4" cols="30" name="titoli[descrizione]" class="inputTextarea ui-corner-all text<?php echo error_field('descrizione', $errors); ?>" id="titoli_descrizione"><?php echo Utils::escape($titoli->getDescrizione()); ?></textarea>
        </div>     

        <div class="field">
            <label>Note</label>
            <textarea rows="4" cols="30" name="titoli[note]" class="inputTextarea ui-corner-all text<?php echo error_field('note', $errors); ?>" id="titoli_note"><?php echo Utils::escape($titoli->getNote()); ?></textarea>
        </div>
        <div class="field">
            <label>Tipo trattativa</label>
               <select name="titoli[tipo_trattativa]" class="inputselect ui-corner-all" id="titoli_tipo_trattativa">
                <option value=""></option>
                <option value="0" <?php if(0 == $titoli->getTipoTrattativa()) echo "selected"?>>Pubblica</option>
                <option value="1" <?php if(1 == $titoli->getTipoTrattativa()) echo "selected"?>>Privata</option>
                </select>
        </div>
        <div class="field">
            <label>Prezzo base</label>
            <input type="text" name="titoli[prezzo_base]" value="<?php echo Utils::escape($titoli->getPrezzoBase()); ?>"
       class="text<?php echo error_field('prezzo_base', $errors); ?>" />
        </div>
        <div class="field">
            <label>Prezzo minimo</label>
            <input type="text" name="titoli[prezzo_minimo]" value="<?php echo Utils::escape($titoli->getPrezzoMinimo()); ?>"
       class="text<?php echo error_field('prezzo_minimo', $errors); ?>" />
        </div>
         <div class="field">
            <label>Cantato</label>
               <select name="titoli[cantato]" class="inputselect ui-corner-all" id="titoli_cantato">
                <option value=""></option>
                <option value="1" <?php if(1 == $titoli->getCantato()) echo "selected"?>>Yes</option>
                <option value="0" <?php if(0 == $titoli->getCantato()) echo "selected"?>>No</option>
                </select>
        </div>
        <div class="field">
            <label>Testo Brano</label>
            <textarea rows="4" cols="30" name="titoli[testo_brano]" class="inputTextarea ui-corner-all text<?php echo error_field('testo_brano', $errors); ?>" id="titoli_testo_brano"><?php echo Utils::escape($titoli->getTestoBrano()); ?></textarea>
        </div>
        <input type="hidden" name="id" value="<?php echo $titoli->getId(); ?>"/>
        
 
        <div class="wrapper">
            <!--<input type="submit" name="cancel" value="CANCEL" class="submit" />-->
            <input type="submit" name="save" value="SALVA" class="submit" />
            <?php 
            $pageID = array_key_exists('pageID', $_GET)?$_GET['pageID']:"";
            $searchtitle = array_key_exists('searchTitle', $_GET)?$_GET['searchTitle']:"";
            $searchisrc = array_key_exists('searchIsrc', $_GET)?$_GET['searchIsrc']:"";
            $searchfindfor = array_key_exists('searchFindFor', $_GET)?$_GET['searchFindFor']:"";
            $str="index.php?page=titoli/listTitoli".(isset($_REQUEST['lang']) && $_REQUEST['lang'] != ""?"&lang=".$_REQUEST['lang']:"").
                                                    ($pageID != ""?"&pageID=".$pageID:"").
                                                    ($searchtitle != ""?"&searchTitle=".$searchtitle:"").
                                                    ($searchfindfor != ""?"&searchFindFor=".$searchfindfor:"").
                                                    ($searchisrc != ""?"&searchIsrc=".$searchisrc:""); ?> 
            <a href="<?php echo $str; ?>" > <?php echo $back?> </a>
        </div>
    </fieldset>
</form>
 <script>
      jQuery(document).ready(function(){
        $(function() {
         var availableTags = [
         <?php 
        $variab = 0;
        $count = count($generi_value);
        foreach($generi_value as $genereVal){ ?>
           "<?php echo $genereVal ?>",
           <?php } ?>
        ];
        $( "#genere" ).autocomplete({
        source: availableTags
        });
        $( "#subgenere" ).autocomplete({
        source: availableTags
        });
        });
        //alert(jQuery('#titoli_cantato').val());
        if(jQuery('#titoli_cantato').val() == '0'){
            jQuery('#titoli_testo_brano').parent().css("display","none");
        }
        jQuery('#titoli_cantato').change(function(){
          jQuery('#titoli_testo_brano').parent().toggle("slow","swing");
        });
   });
</script>
<!--
  </div>
   <div id="bottom-torn"></div>
<img style="display: none;" id="ajax_loader" alt="Please wait" src="/images/ajax-loader.gif">
<img style="position: absolute; display: none; z-index: 2000;" id="bar_loader" alt="Please wait" src="/images/cloud_loader.gif">
<span id="baseurl" style="visibility: hidden">/haveasync/web/backend_dev.php</span>
<span id="culture" style="visibility: hidden">it</span>

<div style="display: none;" id="login-dialog"></div>
<div style="display: none;" id="legenda"></div>
<div style="z-index: 1000; position: fixed; left: 0; right: 0;margin-left: auto;margin-right: auto; bottom: 0; height: 30px; width: 600px" id="fplayer">&nbsp;</div>




</body></html>
-->