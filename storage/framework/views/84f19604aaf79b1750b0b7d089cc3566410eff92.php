<div>
	<table class="table">
		<tr>
			<th><?php echo e(__("t.case_number")); ?> </th>
			<th><?php echo e(__("t.party")); ?> </th>
			<th><?php echo e(__("t.priority")); ?> </th>
			<th><?php echo e(__("t.hearing_on")); ?> </th>
			<th><?php echo e(__("t.action")); ?> </th>
		</tr>
		<tbody>
			<?php $__currentLoopData = $notif; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $n): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr>
			    <td><?php echo e($n->case_number); ?> </td>
			    <td><?php echo e($n->party_name); ?></td>
			    <td><?php echo e($n->priority); ?> </td>
			    <td><?php echo e($n->next_date); ?> </td>
		            <td> <a class="btn btn-primary"href="/admin/case-running/<?php echo e($n->id); ?>"><?php echo e(__("t.open")); ?></a></td>
			</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</tbody>
	</table>
</div>
