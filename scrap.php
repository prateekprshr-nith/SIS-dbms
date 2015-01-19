if(!$set_course)
echo "<p style=\"background-color: #66FF00; width:50%; margin-left:1%; padding-top:1%;border-radius: 16px\"><marquee style=\"height:10;width:200\" scrollamount=\"4\" scrolldelay=\"1\">TIP : Enter Courses to get Started</marquee></p>";





if($give)
{
	echo "<div class=\"container\" style=\"margin-top: -17%;margin-left: 50%\">
		<div class=\"col-md-6\">
			<p class=\"text-center margin-bottom-15\" style=\"margin-bottom: 0%\"><strong><u>New
						Assignment</strong></u></p>
			<form class=\"form-horizontal templatemo-contact-form-2 templatemo-container\" role=\"form\" action=\"contact.php\" method=\"post\">
				<div class=\"form-group\">
					<div class=\"col-sm-4\">
						<div class=\"templatemo-input-icon-container\">
							<label for=\"course\" class=\"control-label\" >Course</label>
							<select id=\"course\" class=\"form-control\" required name=\"course1\">
								<option value=\"\">Select Course Code</option>";


									while($list = $tmp->fetch_assoc())
										echo "<option value=\"".$list["course_code"]. "\">". $list["course_code"]. "</option>";
								echo"
							</select>
						</div>
					</div>
					<div class=\"col-sm-4\">
						<div class=\"templatemo-input-icon-container\">
							<label for=\"course\" class=\"control-label\" >Assignment no.</label>
							<input required type=\"number\" class=\"form-control\" name=\"no\" id=\"name\"
							       placeholder=\"Assingment no.\">
						</div>
					</div>
					<div class=\"col-sm-4\">
						<div class=\"templatemo-input-icon-container\">
							<label for=\"date\" class=\"control-label\" >Due date</label>
							<input required type=\"date\" class=\"form-control\" name=\"name\" id=\"date\">

						</div>
					</div>
					<div class=\"col-sm-12\">
						<div class=\"templatemo-input-icon-container\">
							<label for=\"description\" class=\"control-label\" >Assignment no.</label>
							<textarea required  class=\"form-control\"
							          name=\"description\"
							          id=\"description\" placeholder=\"* Description\"></textarea>
						</div>
					</div>

					<div class=\"col-md-12\">
						<input type=\"submit\" value=\"Give Assignment\" class=\"btn btn-warning pull-right\">
					</div>

				</div>


			</form>

			<div class=\"row\"></div>

		</div>
	</div>";
}
