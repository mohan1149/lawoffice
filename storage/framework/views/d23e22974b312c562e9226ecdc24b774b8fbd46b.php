<div class="container">
<table class="table">
	<tr>
		<th><?php echo e(__("t.name")); ?></th>
		<th> <?php echo e(__("t.uploaded_on")); ?> </th>
		<th> <?php echo e(__("t.actions")); ?></th>
	</tr>	
	<?php $__currentLoopData = $docs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<tr>
			<td> <?php echo e($doc->name); ?> </td>
			<td> <?php echo e($doc->uploaded_on); ?> </td>
			<td> <a href="<?php echo e($doc->url); ?>" target="_blank" class="btn btn-primary"><?php echo e(__("t.open")); ?> </a> </td>
		</tr>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<table>
</div>
