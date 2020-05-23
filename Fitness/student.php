<?php include 'progress_validation.php'; ?>
<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
	<title>Studnet: <?php echo $_SESSION['username']; ?></title>
	<link rel="stylesheet" type="text/css" href="student.css">
	<script type="text/javascript" src="student.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
</head>
<body>

<div id="overall_container">
	<!--user information-->
	<div id="user_container">
		<!--user image-->
		<div id="user_image_container">
			<div id="user_image">
				<img src=<?php echo 'upload/'.$_SESSION['profile_picture']; ?>>
			</div>
		</div>
		<!--user name-->
		<div id="user_name_container">
			<h1><?php echo $_SESSION['username']; ?></h1>
		</div>
		<!--icon option-->
		<div id="icon_option_container">
			<i class="fas fa-clipboard-list" id="to_do_list_button" title="To do list"></i>
			<i class="fas fa-bell" id="show_reminder_button" title="Reminder"></i>
			<i class="fas fa-sign-out-alt" id="logout_button" title="Logout"></i>
		</div>
		<!--option-->
		<div id="option_container">
			<li class="word_option" value="0">Schedule</li>
			<li class="word_option" value="1">Progress</li>
			<li class="word_option" value="2">Courses</li>
			<li class="word_option" value="3">Help</li>
		</div>
		<!--to do list-->
		<div id="to_do_list_container">
			<h1>To do</h1>
			<li>task 1</li>
			<li>task 2</li>
			<li>task 3</li>
		</div>
	</div>

	<!--functional container-->
	<!--schedule container-->
	<div id="schedule_container" class="functional_container">
		<!--calender-->
		<div id="calender_container">
			<!--year & month-->
			<div id="year_month_container">
				<div id="left">
					<i class="fas fa-angle-left" id="left_arrow"></i>
				</div>
				<div id="mid">
					<h1 id="year">2019</h1>
					<h1 id="month">January</h1>
				</div>
				<div id="right">
					<i class="fas fa-angle-right" id="right_arrow"></i>
				</div>
			</div>
			<!--week & day-->
			<table id="week_day_container">
				<tr>
					<th>Mon</th>
					<th>Tue</th>
					<th>Wed</th>
					<th>Thu</th>
					<th>Fri</th>
					<th>Sat</th>
					<th>Sun</th>
				</tr>
				<tr>
					<td>1</td>
					<td>2</td>
					<td>3</td>
					<td>4</td>
					<td>5</td>
					<td>6</td>
					<td>7</td>
				</tr>
				<tr>
					<td>8</td>
					<td>9</td>
					<td>10</td>
					<td>11</td>
					<td>12</td>
					<td>13</td>
					<td>14</td>
				</tr>
				<tr>
					<td>15</td>
					<td>16</td>
					<td>17</td>
					<td>18</td>
					<td>19</td>
					<td>20</td>
					<td>21</td>
				</tr>
				<tr>
					<td>22</td>
					<td>23</td>
					<td>24</td>
					<td>25</td>
					<td>26</td>
					<td>27</td>
					<td>28</td>
				</tr>
				<tr>
					<td>29</td>
					<td>30</td>
					<td>31</td>
					<td colspan="4"></td>
				</tr>
			</table>
		</div>
	</div>
	<!--progress container-->
	<div id="progress_container" class="functional_container">
		<?php dynamic_progress(); ?>
	</div>
	<!--courses container-->
	<div id="courses_container" class="functional_container">
		<!--row 1-->
		<div class="courses_row_container">
			<div class="sub_course_container" id="yoga">
				<!--image-->
				<img src="Image/yoga.jpg">
				<!--types-->
				<div class="sub_course_types_container">
					<h1>Yoga</h1>
					<li>Hatha Yoga</li>
					<li>Iyengar Yoga</li>
					<li>Bikram Yoga</li>
					<li>Vinyasa Yoga</li>
					<li>Kundalini Yoga</li>
				</div>
			</div>
			<div class="sub_course_container" id="gym">
				<!--image-->
				<img src="Image/gym.jpg">
				<!--types-->
				<div class="sub_course_types_container">
					<h1>Gym</h1>
					<li>Shoulder</li>
					<li>Back</li>
					<li>Legs</li>
					<li>Chest</li>
					<li>Abs</li>
				</div>
			</div>
			<div class="sub_course_container" id="swimming">
				<!--image-->
				<img src="Image/swimming.jpg">
				<!--label-->
				<span class="course_label">Swimming</span>
				<!--types-->
				<div class="sub_course_types_container">
					<h1>Swimming</h1>
					<li>Free styles</li>
					<li>Breast stroke</li>
					<li>Back stroke</li>
					<li>Overarm stroke</li>
					<li>Butterfly stroke</li>
				</div>
			</div>
		</div>
		<!--row 2-->
		<div class="courses_row_container">
			<div class="sub_course_container" id="dance">
				<!--image-->
				<img src="Image/dance.jpg">
				<!--label-->
				<span class="course_label">Dance</span>
				<!--types-->
				<div class="sub_course_types_container">
					<h1>Dance</h1>
					<li>Ballet</li>
					<li>Jazz</li>
					<li>Modern</li>
					<li>Hip-hop</li>
					<li>Zumba</li>
				</div>
			</div>
		</div>
	</div>
	<!--help container-->
	<div id="help_container" class="functional_container">
		<div class="contact_container">
			<i class="fas fa-phone"></i>
			<h1>012-3456789</h1>
		</div>
		<div class="contact_container">
			<i class="fas fa-envelope"></i>
			<h1>fitness@gmail.com</h1>
		</div>
		<div class="contact_container">
			<i class="fas fa-map-marker-alt"></i>
			<h1>Persiaran Multimedia, 63100 Cyberjaya, Selangor</h1>
		</div>
	</div>
	<!--reminder-->
	<div id="reminder_container_background">
		<div id="reminder_container">
			<div id="header">
				<h1>Reminder</h1>
				<i class="fas fa-times" id="hide_reminder_button"></i>
			</div>
			<div id="body">
				<p>
					Before you can begin to determine what the composition of a particular paragraph will be, you must first decide on an argument and a working thesis statement for your paper. What is the most important idea that you are trying to convey to your reader? The information in each paragraph must be related to that idea. In other words, your paragraphs should remind your reader that there is a recurrent relationship between your thesis and the information in each paragraph. A working thesis functions like a seed from which your paper, and your ideas, will grow. The whole process is an organic one—a natural progression from a seed to a full-blown paper where there are direct, familial relationships between all of the ideas in the paper.
				</p>
			</div>
		</div>
	</div>

</div>

</body>
</html>