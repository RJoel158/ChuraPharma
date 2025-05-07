function validateForm() {
    const p = document.querySelector('[name=password]').value;
    const c = document.querySelector('[name=confirm]').value;
    if (p.length < 8) {
        alert('La contraseña debe tener al menos 8 caracteres.');
        return false;
    }
    if (p !== c) {
        alert('Las contraseñas no coinciden.');
        return false;
    }
    return true;
}