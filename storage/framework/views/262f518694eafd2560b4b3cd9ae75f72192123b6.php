 <?php $__env->startSection('content'); ?>

<?php if(session()->has('message')): ?>
  <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo e(session()->get('message')); ?></div>
<?php endif; ?>
<?php if(session()->has('not_permitted')): ?>
  <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo e(session()->get('not_permitted')); ?></div>
<?php endif; ?>
<section class="forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h4><?php echo e(trans('file.Reward Point Setting')); ?></h4>
                    </div>
                    <div class="card-body">
                        <p class="italic"><small><?php echo e(trans('file.The field labels marked with * are required input fields')); ?>.</small></p>
                        <?php echo Form::open(['route' => 'setting.rewardPointStore', 'files' => true, 'method' => 'post']); ?>

                            <div class="row">
                                <div class="col-md-3 mt-3">
                                    <div class="form-group">
                                        <?php if($lims_reward_point_setting_data->is_active): ?>
                                        <input type="checkbox" name="is_active" value="1" checked>
                                        <?php else: ?>
                                        <input type="checkbox" name="is_active" value="1">
                                        <?php endif; ?> &nbsp;
                                        <label><?php echo e(trans('file.Active reward point')); ?></label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><?php echo e(trans('file.Sold amount per point')); ?> *</label> <i class="dripicons-question" data-toggle="tooltip" title="<?php echo e(trans('file.This means how much point customer will get according to sold amount. For example, if you put 100 then for every 100 dollar spent customer will get one point as reward.')); ?>"></i>
                                        <input type="number" name="per_point_amount" class="form-control" value="<?php echo e($lims_reward_point_setting_data->per_point_amount); ?>" required />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><?php echo e(trans('file.Minumum sold amount to get point')); ?> * <i class="dripicons-question" data-toggle="tooltip" title="<?php echo e(trans('file.For example, if you put 100 then customer will only get point after spending 100 dollar or more.')); ?>"></i></label>
                                        <input type="number" name="minimum_amount" class="form-control" value="<?php echo e($lims_reward_point_setting_data->minimum_amount); ?>" required />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label><?php echo e(trans('file.Point Expiry Duration')); ?></label>
                                        <input type="number" name="duration" class="form-control" value="<?php echo e($lims_reward_point_setting_data->duration); ?>" />
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label><?php echo e(trans('file.Duration Type')); ?></label>
                                        <select name="type" class="form-control">
                                            <?php if($lims_reward_point_setting_data->type == 'Year'): ?>
                                                <option selected value="Year">Years</option>
                                                <option value="Month">Months</option>
                                            <?php else: ?>
                                                <option value="Year">Years</option>
                                                <option selected value="Month">Months</option>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 form-group">
                                    <button type="submit" class="btn btn-primary"><?php echo e(trans('file.submit')); ?></button>
                                </div>
                            </div>
                        <?php echo Form::close(); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script type="text/javascript">
    $("ul#setting").siblings('a').attr('aria-expanded','true');
    $("ul#setting").addClass("show");
    $("ul#setting #reward-point-setting-menu").addClass("active");

    $('[data-toggle="tooltip"]').tooltip();

</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layout.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\lnmedra\resources\views/setting/reward_point_setting.blade.php ENDPATH**/ ?>