<h4 style="text-align: center;"> List of Faculty Completed Research </h4>
<h5 style="text-align: center;"><?= $year_start?> - <?= $year_end?></h5>

<table cellspacing="0" cellpadding="5" border="1">
  <tr style="text-align: center;">
    <td width="5%"> <b>#</b> </td>
    <td width="20%"> <b>Research Title</b> </td>
    <td width="15%"><b>Author</b> </td>
    <td width="45%"> <b>Abstract</b> </td>
    <td width="10%"> <b>Year Completed</b> </td>

  </tr>
  <?php if (empty($p_seminar)): ?>
    <tr>
      <td colspan="7" style="text-align: center;"> No Available Data </td>
    </tr>
  <?php else: ?>
    <?php $ctr = 1; ?>
    <?php foreach ($p_seminar as $document): ?>
      <tr style="text-align: justify;">
        <td> <?=$ctr?> </td>
        <td> <?=$document['research_title']?> </td>
        <td><?php echo ucwords($document['first_name']. " ".$document['last_name']); ?></td>
        <td> <?=$document['abstract']?> </td>
        <td> <?=$document['school_year']?> </td>

        </tr>
      <?php $ctr++; ?>
    <?php endforeach; ?>
  <?php endif; ?>
</table>
