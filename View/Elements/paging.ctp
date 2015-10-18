<p class="paging small">
    <?= $this->Paginator->counter([
        'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}'),
    ]); ?>
</p>