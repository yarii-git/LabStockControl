function toggleConsumptions(productId) {
    var consumptionsDiv = document.getElementById('consumptions_' + productId);
    if (consumptionsDiv.classList.contains('hidden')) {
        consumptionsDiv.classList.remove('hidden');
    } else {
        consumptionsDiv.classList.add('hidden');
    }
}
