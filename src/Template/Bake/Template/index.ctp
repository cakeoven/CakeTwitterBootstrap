<%
/**
* CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
* Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
*
* Licensed under The MIT License
* For full copyright and license information, please see the LICENSE.txt
* Redistributions of files must retain the above copyright notice.
*
* @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
* @link          http://cakephp.org CakePHP(tm) Project
* @since         0.1.0
* @license       http://www.opensource.org/licenses/mit-license.php MIT License
*/
use Cake\Utility\Inflector;

$fields = collection($fields)
->filter(function($field) use ($schema) {
return !in_array($schema->columnType($field), ['binary', 'text']);
})
->take(7);
%>
<div class="row">
    <div class="col-lg-2 col-md-3">
        <div class="panel panel-default">
            <div class="panel-heading"><?= __('Actions') ?></div>
            <ul class="list-group">
                <li class="list-group-item"><?= $this->Html->link(__('New <%= $singularHumanName %>'), ['action' => 'add']) ?></li>
                <%
                $done = [];
                foreach ($associations as $type => $data):
                    foreach ($data as $alias => $details):
                        if (!empty($details['navLink']) && $details['controller'] !== $this->name && !in_array($details['controller'], $done)):
                %>
                <li class="list-group-item"><?= $this->Html->link(__('List <%= $this->_pluralHumanName($alias) %>'), ['controller' => '<%= $details['controller'] %>', 'action' => 'index']) ?></li>
                <li class="list-group-item"><?= $this->Html->link(__('New <%= $this->_singularHumanName($alias) %>'), ['controller' => '<%= $details['controller'] %>', 'action' => 'add']) ?></li>
                <%
                            $done[] = $details['controller'];
                        endif;
                    endforeach;
                endforeach;
                %>
            </ul>
        </div>
    </div>
    <div class="col-lg-10 col-md-9">
        <table class="table table-hover table-striped table-bordered small">
            <thead>
            <tr>
                <% foreach ($fields as $field): %>
                <th><?= $this->Paginator->sort('<%= $field %>') ?></th>
                <% endforeach; %>
                <th><?= __('Actions') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($<%= $pluralVar %> as $<%= $singularVar %>): ?>
            <tr>
                <%        foreach ($fields as $field) {
                $isKey = false;
                if (!empty($associations['BelongsTo'])) {
                foreach ($associations['BelongsTo'] as $alias => $details) {
                if ($field === $details['foreignKey']) {
                $isKey = true;
                %>
                <td>
                    <?= $<%= $singularVar %>->has('<%= $details['property'] %>') ? $this->Html->link($<%= $singularVar %>-><%= $details['property'] %>-><%= $details['displayField'] %>, ['controller' => '<%= $details['controller'] %>', 'action' => 'view', $<%= $singularVar %>-><%= $details['property'] %>-><%= $details['primaryKey'][0] %>]) : '' ?>
                </td>
                <%
                break;
                }
                }
                }
                if ($isKey !== true) {
                if (!in_array($schema->columnType($field), ['integer', 'biginteger', 'decimal', 'float'])) {
                %>
                <td><?= h($<%= $singularVar %>-><%= $field %>) ?></td>
                <%
                } else {
                %>
                <td><?= $this->Number->format($<%= $singularVar %>-><%= $field %>) ?></td>
                <%
                }
                }
                }
    
                $pk = '$' . $singularVar . '->' . $primaryKey[0];
                %>
                <td>
                    <?= $this->Html->link('', ['action' => 'view', <%= $pk %>], ['icon' => ['class' => 'fa fa-search fa-fw fa-2x']]); ?>
                    <?= $this->Html->link('', ['action' => 'edit', <%= $pk %>], ['icon' => ['class' => 'fa fa-pencil fa-fw fa-2x']]); ?>
                    <?= $this->Form->postLink('', ['action' => 'delete', <%= $pk %>], [
                            'icon' => ['class' => 'fa fa-times fa-fw fa-2x text-danger'],
                            'confirm' => __('Are you sure you want to delete # {0}?', <%= $pk %>)
                        ]);
                    ?>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <div class="paginator">
            <?= $this->element('CakeBootstrap.pagination') ?>
            <?= $this->element('CakeBootstrap.paging') ?>
        </div>
    </div>
</div>