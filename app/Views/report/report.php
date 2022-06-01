<h4 style="text-align: center;"> List of Researches </h4>
<h5 style="text-align: center;"><?= $information[0]['course_name']?> | <?= $year_start?> - <?= $year_end?></h5>
<table cellspacing="0" cellpadding="5" border="1">
  <tr style="text-align: center;">
    <td width="5%"> <b>#</b> </td>
    <td width="30%"> <b>Title</b> </td>
    <td width="55%"> <b>Abstract</b> </td>
    <td width="10%"> <b>School Year</b> </td>
  </tr>
  <?php if (empty($information)): ?>
    <tr>
      <td colspan="7" style="text-align: center;"> No Available Data </td>
    </tr>
  <?php else: ?>
    <?php $ctr = 1; ?>
    <?php foreach ($information as $document): ?>
      <tr style="text-align: justify;">
        <td> <?=$ctr?> </td>
        <td> <?=$document['title']?> </td>
        <td> <?=$document['abstract']?> </td>
        <td> <?=$document['school_year']?> </td>
        </tr>
      <?php $ctr++; ?>
    <?php endforeach; ?>
  <?php endif; ?>
</table>
