<?php
	ob_start();
	require("connect.php");
	if(!isset($_SESSION['username']))
    {
        header('location:login.php');
    }
    else
    {
        //Proceed with Game Home
    }

	$username=$_SESSION['username'];
	$q8="SELECT name, score, pic FROM stuinfo, quizuser WHERE stuinfo.username=quizuser.username AND quizuser.username='$username'";
	$r8=mysqli_query($con, $q8);
	if(mysqli_num_rows($r8)==1)
	{
		$row=mysqli_fetch_array($r8);
		$name=$row['name'];
		$score=$row['score'];
		$q9="SELECT count(id) as rank FROM quizuser WHERE score>$score ORDER BY time ASC";
		$r9=mysqli_query($con,$q9);
		$q91="SELECT count(id)as total FROM quizuser";
		$r91=mysqli_query($con, $q91);
		$row1=mysqli_fetch_array($r9);
		$row2=mysqli_fetch_array($r91);
		$total=$row2['total'];
		$rank=$row1['rank']+1;
		$ahead=$rank-1;
		$behind=$total-$rank;
		$ahead=($ahead/$total)*100;
		$behind=($behind/$total)*100;
		$ahead=round( $ahead, 2, PHP_ROUND_HALF_UP);
		$behind=round( $behind, 2, PHP_ROUND_HALF_UP);
	}

?>
<ul id="navbar">
	<li id="home"><a href="home.php">Home</a></li>
	<li id="profile"><a href="profile.php">My Profile</a></li>
	<li id="play"><a href="home.php">Renaissance Pirates</a></li>
	<li id="rules"><a href="rules.php">Rules</a></li>
	<li id="contacts"><a href="contact.php">Contacts</a></li>
</ul>
<div id="userdetails">
<table width="80%" >
	<tr>
		<td width="27%" align="right"> Name - <span class="bold"><?php echo $name; ?></span></td>
		<td width="6%">Rank - <span class="bold"><?php echo $rank; ?></span></td>
		<td width="6%">Score - <span class="bold"><?php echo $score; ?></span></td>
		<td width="12%" align="center"><span class="bold "><a href="logout.php" class="logout">LOGOUT</a></span></td>
	</tr>
	<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
	<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
	<tr>
		<td>
		<?php
					if($row['pic']!=null)
						echo '<img src="'.$row['pic'].'" alt="Profile Picture" height="80" width="80"/>';
					else
						echo '<img src="img/default.gif" alt="Profile Picture" height="80" width="80"/>';
		?>
		</td>
		<td width="22%">
				<?php echo '<em>Users Ahead of You :</em><strong> '.$ahead.'%</strong>'; ?>
		</td>
		<td width="20%">
				<?php echo '<em>Users Behind You :</em><strong> '.$behind.'%</strong>'; ?>
		</td>
	</tr>
</table>
</div>