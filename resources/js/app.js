import './bootstrap';
import 'flowbite';

//ovo je sve dodato kako bi se meni pravilno ucitvao
document.addEventListener("livewire:navigating", () => {
    // Mutate the HTML before the page is navigated away...
    initFlowbite();
});

document.addEventListener("livewire:navigated", () => {
    // Reinitialize Flowbite components
    initFlowbite();
});