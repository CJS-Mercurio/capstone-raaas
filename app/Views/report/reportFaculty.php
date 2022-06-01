<h4 style="text-align: center;"> Faculty Seminars/ Conferences and Trainings Attended </h4>
<table cellspacing="0" cellpadding="5" border="1">
  <tr style="text-align: center;">
    <td width="5%"> <b>#</b> </td>
    <td width="18%"> <b>Professor</b> </td>
    <td width="18%"> <b>Seminar Title</b> </td>
    <td width="18%"> <b>Sponsor</b> </td>
    <td width="18%"> <b>Venue</b> </td>
    <td width="18%"> <b>Event Date</b> </td>
  </tr>
  <?php if (empty($p_seminar)): ?>
    <tr>
      <td colspan="7" style="text-align: center;"> No Available Data </td>
    </tr>
  <?php else: ?>
    <?php $ctr = 1; ?>
    <?php foreach ($p_seminar as $document): ?>
      <tr style="text-align: center;">
        <td> <?=$ctr?> </td>
        <td>
        <?= $document['firstname']. ' ' . $document['lastname'] ?></td>
        <td> <?=$document['event_title']?> </td>
        <td> <?=$document['sponsor']?> </td>
        <td> <?=$document['venue']?> </td>
        <?php $t=strtotime($document['date_attended']); ?>
        <?php $date = date("M-d-Y", $t);?>
        <td><?php echo $date; ?></td>
        </tr>
      <?php $ctr++; ?>
    <?php endforeach; ?>
  <?php endif; ?>
</table>
