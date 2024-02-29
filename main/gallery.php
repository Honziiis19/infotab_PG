<?php
    require_once "admin/service/connect_db.php";
    $con = connect_db();

    $aktivniprezsql = "SELECT id FROM infotabdb.prezentace WHERE aktivni = '1'";
    $aktivniprezresult = mysqli_query($con, $aktivniprezsql);

    if ($aktivniprezresult && $row = mysqli_fetch_assoc($aktivniprezresult)) {
        $aktivniprezId = $row['id'];
        // $scrollText = $row['scrolltext'];
    } else {
        echo "Žádná aktivní prezentace";
        exit;
    }

    $snimkysql = "SELECT htmltext FROM infotabdb.snimky WHERE prezentace_id = $aktivniprezId";
    $snimkyresult = mysqli_query($con, $snimkysql);

    if ($snimkyresult) {
        while ($row = mysqli_fetch_assoc($snimkyresult)) {
            echo '<section data-transition="zoom">'.$row['htmltext'].'</section>';
        }
    } else {
        echo "Žádné snímky pro tuto prezentaci.";
    };
?>
<!--
<section data-transition="zoom">
<h2>Vítejte na dni otevřených dvěří Gymnázia Tišnov!</h2>
<br/>
V době od 8 do 15h jsou pro zájemce přístupné prostory školy
k nahlédnutí.
Plnohodnotný DOD s&nbsp;programem proběhne v&nbsp;sobotu 13.1.
a v&nbsp;úterý 30.1.2024.
</section>


<section data-transition="slide-in fade-out">
<img src="img/gallery/b1_priz.png" style=" height: 100%" />
-->
<!--<br/>
<small>Hlavní budova příz.</small>
</section> -->
<!--
<section data-transition="zoom">
<h2>Do vedlejší budovy 2<br/>
se dostanete můstkem<br/>
v 1.&nbsp;patře.</h2>
</section>


<section data-transition="fade">
<img src="img/gallery/b1_p1.png" style="margin-top: 80px;" />
-->
<!--<br/>
<small>Hlavní budova 1.p.</small>-->
<!--
</section>


<section data-transition="fade">
<img src="img/gallery/b1_p2.png" style="margin-top: 80px;" />
-->
<!--<br/>
<small>Hlavní budova 2.p.</small>-->
<!--
</section>

<section data-transition="slide-in fade-out">
<img src="img/gallery/b2_p2.png" style="margin-top: 80px;" />
-->
<!--<br/>
<small>Vedlejší budova 2.p.</small>-->
<!--
</section>


<section data-transition="fade">
<img src="img/gallery/b2_p1.png" style="margin-top: 80px;" />
-->
<!--<br/>
<small>Vedlejší budova 2.p.</small>-->
<!--
</section>

<section data-transition="zoom">
<h2>Do budovy NG<br/>
se dostanete vstupem<br/>
z ul.&nbsp;Riegrova&nbsp;2.</h2>
</section>

<section data-transition="slide-in fade-out">
<img src="img/gallery/b3_p2.png" style="margin-top: 80px;" />
-->
<!--<br/>
<small>Budova Riegrova (NG) 2.p.</small>-->
<!--
</section>


<section data-transition="zoom">
<h2>Beseda s vedením školy proběhne od 14 hod v&nbsp;učebně D-Z (hl. budova 1. patro).</h2>
</section>
-->

