<textarea
    {include file="editors/editor_options.tpl" Editor=$TextArea}
    class="form-control"
    {if $TextArea->getPlaceholder()}
        placeholder="{$TextArea->getPlaceholder()}"
    {/if}
    {if $TextArea->GetColumnCount()}
        cols="{$TextArea->GetColumnCount()}"
    {/if}
    {if $TextArea->GetRowCount()}
        rows="{$TextArea->GetRowCount()}"
    {/if}>{$TextArea->GetValue()}</textarea>