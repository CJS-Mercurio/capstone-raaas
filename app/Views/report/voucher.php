<!-- <b>Research Title: </b><?= $information[0]['rtitle'] ?>
<br>
<b>Names: </b> <?php foreach ($information as $student){
  echo $student['rln']. ' ' . $student['rfn']. ', <br>';

} ?>
<br>
<b>Date</b> <?= date('F d, Y')?> -->

<h4 style="text-align:center">Research Voucher</h4>
<table cellpadding="5">
    <tr>
      <td width="20%"><b>Research Title: </b></td>
      <td><?= $information[0]['rtitle'] ?></td>
    </tr>
    <tr>
      <td><b>Authors: </b></td>
        <td><?php foreach ($information as $student){
        echo $student['rfn']. ' ' . $student['rmn'] . ' ' . $student['rln']. ', ';}?></td>
    </tr>
    <tr>
      <td><b>Course: </b> </td>
      <td><?= $information[0]['course_name'] ?></td>
    </tr>
    <tr>
      <td><b>Date Submitted to Professor: </b> </td>
      <td><?= date('F d, Y',strtotime($information[0]['date_submitted'])) ?></td>
    </tr>
    <tr>
      <td><b>Date Uploaded in System: </b> </td>
      <td><?= date('F d, Y',strtotime($information[0]['created_at'])) ?></td>
    </tr>
  </table>

  <p style="font-size: 8;"><i>*Present this voucher to the Library together with the hard copy of your research.<i></p>
