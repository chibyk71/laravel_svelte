<script>
    import { onMount } from "svelte";
    import { EyeRegular, EyeSlashRegular } from "svelte-awesome-icons";

    let showPass = false;
    let feildname = "password";
    export {feildname as name}
    export let value;

    export let placeholder = "New Password"

    let Input;
    
    $:{
        if (Input && showPass) {
            Input.type = showPass? "text": 'password';
        }
    }
</script>

<div class="mb-3 input-group input-group-icon">
    <span class="input-group-text">
        <div class="input-icon">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M5 12C4.44772 12 4 12.4477 4 13V20C4 20.5523 4.44772 21 5 21H19C19.5523 21 20 20.5523 20 20V13C20 12.4477 19.5523 12 19 12H5ZM2 13C2 11.3431 3.34315 10 5 10H19C20.6569 10 22 11.3431 22 13V20C22 21.6569 20.6569 23 19 23H5C3.34315 23 2 21.6569 2 20V13Z" fill="white"></path>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M12 3C10.9391 3 9.92172 3.42143 9.17157 4.17157C8.42143 4.92172 8 5.93913 8 7V11C8 11.5523 7.55228 12 7 12C6.44772 12 6 11.5523 6 11V7C6 5.4087 6.63214 3.88258 7.75736 2.75736C8.88258 1.63214 10.4087 1 12 1C13.5913 1 15.1174 1.63214 16.2426 2.75736C17.3679 3.88258 18 5.4087 18 7V11C18 11.5523 17.5523 12 17 12C16.4477 12 16 11.5523 16 11V7C16 5.93913 15.5786 4.92172 14.8284 4.17157C14.0783 3.42143 13.0609 3 12 3Z" fill="white"></path>
            </svg>
        </div>
    </span>
    <input bind:value name={feildname} bind:this={Input} type="password" class="form-control block w-full dz-password" {placeholder}>
    <!-- svelte-ignore a11y-no-static-element-interactions -->
    <span class="input-group-text show-pass" on:click={()=>showPass=!showPass} on:keypress>
        <svelte:component this={showPass?EyeRegular:EyeSlashRegular} class="fill-primary"/>
    </span>
</div>