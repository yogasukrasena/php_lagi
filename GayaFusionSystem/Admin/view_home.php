<?
include ("kios_config.php");
$jumlah_katalog = mysql_num_rows(mysql_query("select * from kios_buku"));
$jumlah_member = mysql_num_rows(mysql_query("select * from tblUser"));
$jumlah_news = mysql_num_rows(mysql_query("select * from kios_news"));
$jumlah_pemesan = mysql_num_rows(mysql_query("select * from kios_belanja where or_pesan='1'"));
$jumlah_guestbook = mysql_num_rows(mysql_query("select * from kios_guestbook"));
?>
<table width="80%" border="0" cellpadding="0" cellspacing="0" id="table_isi">
    <tr>
    <td><strong>Home</strong></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="3" cellpadding="3">
      <tr>
        <td colspan="2"><div align="center" class="txt-judul"><strong>Statistik Kios Buku Online </strong> </div></td>
        </tr>
      <tr>
        <td width="37%" class="katalog"><div align="right">Jumlah Katalog </div></td>
        <td width="63%" class="katalog"><strong><?=$jumlah_katalog?> Buku </strong></td>
      </tr>
      <tr>
        <td class="katalog"><div align="right">Jumlah Member </div></td>
        <td class="katalog"><strong><?=$jumlah_member?> Orang </strong></td>
      </tr>
      <tr>
        <td class="katalog"><div align="right">Jumlah Berita </div></td>
        <td class="katalog"><strong><?=$jumlah_news?> Judul</strong> </td>
      </tr>
      <tr>
        <td class="katalog"><div align="right">Jumlah Pengisi Buku Tamu </div></td>
        <td class="katalog"><strong><?=$jumlah_guestbook?> Record</strong> </td>
      </tr>
      <tr>
        <td class="katalog"><div align="right">Jumlah Pemesan Baru </div></td>
        <td class="katalog"><strong><?=$jumlah_pemesan?> Pemesan</strong> </td>
      </tr>
    </table></td>
  </tr>
</table>