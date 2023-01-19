@if ($paginator->hasPages())
<ul style="display:flex; justify-content:justify-between; width:100%">
    <button wire:click="previousPage">Atgal</button>
    <button wire:click="nestPage">Kitas</button>
</ul>
@endif