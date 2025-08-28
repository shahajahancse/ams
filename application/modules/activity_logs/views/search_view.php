<form method="get" action="">
	
	<?php if($this->ion_auth->is_admin()){ ?>                     
	<div class="row">
		<div class="col-md-2">
			<?php $more_attr = 'class="form-control input-sm" id="region"';
			echo form_dropdown('region', $regions, $_GET['region'], $more_attr);
			?>
		</div>     
		<div class="col-md-2">
			<?php $more_attr = 'class="sc_district_val form-control input-sm" id="sc_district"';
			echo form_dropdown('district', $scouts_district, $_GET['district'], $more_attr);
			?>
			<!-- <select name="district" class="sc_district_val form-control input-sm" id="sc_district">
				<option value="">-- Scouts District --</option>
			</select> -->
		</div>     
		<div class="col-md-3">
			<?php $more_attr = 'class="sc_upazila_thana_val form-control input-sm" id="sc_upazila_thana"';
			echo form_dropdown('upazila', $scouts_upazila, $_GET['upazila'], $more_attr);
			?>
			<!-- <select name="upazila" class="sc_upazila_thana_val form-control input-sm" id="sc_upazila_thana">
				<option value="">-- Scouts Upazila --</option>
			</select> -->
		</div>           
		<div class="col-md-3"> 
		    <?php $more_attr = 'class="sc_group_val form-control input-sm"';
			echo form_dropdown('sgroup', $scouts_group, $_GET['sgroup'], $more_attr);
			?>    
			<!-- <select name="sgroup" class="sc_group_val form-control input-sm">
				<option value="">-- Scouts Group --</option>
			</select> -->
		</div>
		<div class="col-md-2">
			<?php $more_attr = 'class="form-control input-sm"';
			echo form_dropdown('memberType', $member_type, $_GET['memberType'], $more_attr);
			?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-2 marTopSearch">
			<input type="text" name="scoutID" class="form-control input-sm uppercaseText" value="<?=$_GET['scoutID']?>" placeholder="Scout ID">
		</div>

		<div class="col-md-2 marTopSearch">     
			<input type="text" name="name" class="form-control input-sm" value="<?=$_GET['name']?>" placeholder="Name"> 
		</div>

		<div class="col-md-2 marTopSearch">     
			<input type="text" name="username" class="form-control input-sm"  value="<?=$_GET['username']?>"placeholder="Username"> 
		</div>

		<div class="col-md-2 marTopSearch">
			<select name="gender" class="form-control input-sm">
				<option value="">-- Gender --</option>
				<option value="Male" <?= $_GET['gender']=='Male'?'selected':''; ?>>Male</option>
				<option value="Female" <?= $_GET['gender']=='Female'?'selected':''; ?>>Female</option>
				<option value="Others" <?= $_GET['gender']=='Others'?'selected':''; ?>>Others</option>
			</select>
		</div>
		<div class="col-md-2 marTopSearch">
			<?php $more_attr = 'class="form-control input-sm"';
			echo form_dropdown('section', $scout_section, $_GET['section'], $more_attr);
			?>
		</div>
		<div class="col-md-1 marTopSearch">
			<div class="pull-right ">
				<button type="submit" class="btn btn-blueviolet btn-mini"><i class="icon-ok"></i> Search</button>
			</div>
		</div>
	</div>

	<?php } ?>


	<?php if($this->ion_auth->is_region_admin()){ ?>
	<div class="row">
		<div class="col-md-3">
			<?php $more_attr = 'class="form-control input-sm" id="sc_district"';
			echo form_dropdown('district', $scouts_district, $_GET['district'], $more_attr);
			?>
		</div>  
		<div class="col-md-3">
			<?php $more_attr = 'class="sc_upazila_thana_val form-control input-sm" id="sc_upazila_thana"';
			echo form_dropdown('upazila', $scouts_upazila, $_GET['upazila'], $more_attr);
			?>
			<!-- <select name="upazila" class="sc_upazila_thana_val form-control input-sm" id="sc_upazila_thana">
				<option value="">-- Scouts Upazila --</option>
			</select> -->
		</div>           
		<div class="col-md-4"> 
		    <?php $more_attr = 'class="sc_group_val form-control input-sm"';
			echo form_dropdown('sgroup', $scouts_group, $_GET['sgroup'], $more_attr);
			?>    
			<!-- <select name="sgroup" class="sc_group_val form-control input-sm">
				<option value="">-- Scouts Group --</option>
			</select> -->
		</div>
		<div class="col-md-2">
			<?php $more_attr = 'class="form-control input-sm"';
			echo form_dropdown('memberType', $member_type, $_GET['memberType'], $more_attr);
			?>
		</div>		
	</div>
	<div class="row">
		<div class="col-md-2 marTopSearch">
			<input type="text" name="scoutID" class="form-control input-sm uppercaseText" value="<?=$_GET['scoutID']?>" placeholder="Scout ID">
		</div>
		<div class="col-md-3 marTopSearch">     
			<input type="text" name="name" class="form-control input-sm" value="<?=$_GET['name']?>" placeholder="Name" > 
		</div>
		<div class="col-md-2 marTopSearch">     
			<input type="text" name="username" class="form-control input-sm" value="<?=$_GET['username']?>" placeholder="Username"> 
		</div>
		<div class="col-md-2 marTopSearch">
			<select name="gender" class="form-control input-sm">
				<option value="">-- Gender --</option>
				<option value="Male" <?= $_GET['gender']=='Male'?'selected':''; ?>>Male</option>
				<option value="Female" <?= $_GET['gender']=='Female'?'selected':''; ?>>Female</option>
				<option value="Others" <?= $_GET['gender']=='Others'?'selected':''; ?>>Others</option>
			</select>
		</div>
		<div class="col-md-2 marTopSearch">
			<?php $more_attr = 'class="form-control input-sm"';
			echo form_dropdown('section', $scout_section, $_GET['section'], $more_attr);
			?>
		</div>
		<div class="col-md-1 marTopSearch">
			<div class="pull-right ">
				<button type="submit" class="btn btn-blueviolet btn-mini"><i class="icon-ok"></i> Search</button>
			</div>
		</div>
	</div>
	<?php } ?>

	<?php if($this->ion_auth->is_district_admin()){ ?>
	<div class="row">
		<div class="col-md-3">
			<?php $more_attr = 'class="form-control input-sm" id="sc_upazila_thana"';
			echo form_dropdown('upazila', $scouts_upazila, $_GET['upazila'], $more_attr);
			?>
		</div>  
		<div class="col-md-4"> 
		    <?php $more_attr = 'class="sc_group_val form-control input-sm"';
			echo form_dropdown('sgroup', $scouts_group, $_GET['sgroup'], $more_attr);
			?>    
			<!-- <select name="sgroup" class="sc_group_val form-control input-sm">
				<option value="">-- Scouts Group --</option>
			</select> -->
		</div>
		<div class="col-md-3">
			<?php $more_attr = 'class="form-control input-sm"';
			echo form_dropdown('memberType', $member_type, $_GET['memberType'], $more_attr);
			?>
		</div>
		<div class="col-md-2">
			<?php $more_attr = 'class="form-control input-sm"';
			echo form_dropdown('section', $scout_section, $_GET['section'], $more_attr);
			?>
		</div>
	</div>	

	<div class="row">
		<div class="col-md-2 marTopSearch">
			<input type="text" name="scoutID" class="form-control input-sm uppercaseText" value="<?=$_GET['scoutID']?>" placeholder="Scout ID">
		</div>
		<div class="col-md-3 marTopSearch">     
			<input type="text" name="name" class="form-control input-sm" value="<?=$_GET['name']?>" placeholder="Name"> 
		</div>
		<div class="col-md-3 marTopSearch">     
			<input type="text" name="username" class="form-control input-sm" value="<?=$_GET['username']?>" placeholder="Username"> 
		</div>
		<div class="col-md-2 marTopSearch">
			<select name="gender" class="form-control input-sm">
				<option value="">-- Gender --</option>
				<option value="Male" <?= $_GET['gender']=='Male'?'selected':''; ?>>Male</option>
				<option value="Female" <?= $_GET['gender']=='Female'?'selected':''; ?>>Female</option>
				<option value="Others" <?= $_GET['gender']=='Others'?'selected':''; ?>>Others</option>
			</select>
		</div>
		<div class="col-md-1 marTopSearch">
			<div class="pull-right ">
				<button type="submit" class="btn btn-blueviolet btn-mini"><i class="icon-ok"></i> Search</button>
			</div>
		</div>
	</div>
	<?php } ?>

	<?php if($this->ion_auth->is_upazila_admin()){ ?>
	<div class="row">
		<div class="col-md-6">
			<?php $more_attr = 'class="form-control input-sm"';
			echo form_dropdown('sgroup', $scouts_group, $_GET['sgroup'], $more_attr);
			?>
		</div>  
		<div class="col-md-3">
			<?php $more_attr = 'class="form-control input-sm"';
			echo form_dropdown('memberType', $member_type, $_GET['memberType'], $more_attr);
			?>
		</div>
		<div class="col-md-3">
			<?php $more_attr = 'class="form-control input-sm"';
			echo form_dropdown('section', $scout_section, $_GET['section'], $more_attr);
			?>
		</div>		
	</div>	

	<div class="row">
		<div class="col-md-2 marTopSearch">
			<input type="text" name="scoutID" class="form-control input-sm uppercaseText" value="<?=$_GET['scoutID']?>" placeholder="Scout ID">
		</div>
		<div class="col-md-3 marTopSearch">     
			<input type="text" name="name" class="form-control input-sm" value="<?=$_GET['name']?>" placeholder="Name"> 
		</div>
		<div class="col-md-3 marTopSearch">     
			<input type="text" name="username" class="form-control input-sm" value="<?=$_GET['username']?>" placeholder="Username"> 
		</div>
		<div class="col-md-2 marTopSearch">
			<select name="gender" class="form-control input-sm">
				<option value="">-- Gender --</option>
				<option value="Male" <?= $_GET['gender']=='Male'?'selected':''; ?>>Male</option>
				<option value="Female" <?= $_GET['gender']=='Female'?'selected':''; ?>>Female</option>
				<option value="Others" <?= $_GET['gender']=='Others'?'selected':''; ?>>Others</option>
			</select>
		</div>
		<div class="col-md-1 marTopSearch">
			<div class="pull-right ">
				<button type="submit" class="btn btn-blueviolet btn-mini"><i class="icon-ok"></i> Search</button>
			</div>
		</div>
	</div>
	<?php } ?>

	<?php if($this->ion_auth->is_group_admin()){ ?>
	<div class="row">
		<div class="col-md-3">
			<?php $more_attr = 'class="form-control input-sm"';
			echo form_dropdown('section', $scout_section, set_value('section'), $more_attr);
			?>
		</div>		
		<div class="col-md-2">
			<input type="text" name="scoutID" class="form-control input-sm uppercaseText" value="<?=$_GET['scoutID']?>"  placeholder="Scout ID">
		</div>
		<div class="col-md-2">     
			<input type="text" name="name" class="form-control input-sm" value="<?=$_GET['name']?>"  placeholder="Name"> 
		</div>
		<div class="col-md-2">     
			<input type="text" name="username" class="form-control input-sm"  value="<?=$_GET['username']?>" placeholder="Username"> 
		</div>
		<div class="col-md-2">
			<select name="gender" class="form-control input-sm">
				<option value="">-- Gender --</option>
				<option value="Male" <?= $_GET['gender']=='Male'?'selected':''; ?>>Male</option>
				<option value="Female" <?= $_GET['gender']=='Female'?'selected':''; ?>>Female</option>
				<option value="Others" <?= $_GET['gender']=='Others'?'selected':''; ?>>Others</option>
			</select>
		</div>
		<div class="col-md-1">
			<div class="pull-right ">
				<button type="submit" class="btn btn-blueviolet btn-mini"><i class="icon-ok"></i> Search</button>
			</div>
		</div>
	</div>
	<?php } ?>
	
</form>

<div class="clearfix"></div>
<hr >