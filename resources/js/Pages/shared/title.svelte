<script>
    const APP_NAME = import.meta.env.APP_NAME || 'FlauntIt';
    export let title; 
</script>
<svelte:head>
    <title>{title} - {APP_NAME}</title>
</svelte:head>