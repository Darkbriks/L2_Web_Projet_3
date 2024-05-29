document.addEventListener('DOMContentLoaded', function()
{
    initializeTheme();
    document.getElementById('theme-toggle').addEventListener('click', changeTheme);
});

function initializeTheme()
{
    const savedTheme = localStorage.getItem('theme') || 'dark';
    document.body.classList.add(`${savedTheme}-theme`);
    document.getElementById('theme-toggle').textContent = savedTheme === 'dark' ? 'Mode Clair' : 'Mode Sombre';
}

function changeTheme()
{
    let dark = localStorage.getItem('theme') !== 'dark';
    let oldTheme = dark ? 'light-theme' : 'dark-theme';
    let newTheme = dark ? 'dark-theme' : 'light-theme';

    document.body.classList.replace(oldTheme, newTheme);
    document.getElementById('theme-toggle').textContent = dark ? 'Mode Clair' : 'Mode Sombre';
    localStorage.setItem('theme', dark ? 'dark' : 'light');
}
