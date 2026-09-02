

document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.querySelector('input[name="search"]');
    const categorySelect = document.querySelector('select[name="category"]');
    const typeSelect = document.querySelector('select[name="type"]');
    
    
    const catalogContainer = document.getElementById('catalogContainer');

    function filterResources() {
        if (!catalogContainer) return;

        const keyword = (searchInput ? searchInput.value : '').toLowerCase().trim();
        const selectedCategory = (categorySelect ? categorySelect.value : '').trim();
        const selectedType = (typeSelect ? typeSelect.value : '').toLowerCase().trim();

        const cards = catalogContainer.querySelectorAll('.resource-card-item');
        let visibleCount = 0;

        cards.forEach(card => {
            const title = (card.getAttribute('data-title') || '').toLowerCase();
            const description = (card.getAttribute('data-desc') || '').toLowerCase();
            const categoryId = (card.getAttribute('data-category') || '').trim();
            const sharingType = (card.getAttribute('data-type') || '').toLowerCase().trim();

            const matchesKeyword = !keyword || title.includes(keyword) || description.includes(keyword);
            const matchesCategory = !selectedCategory || categoryId === selectedCategory;
            const matchesType = !selectedType || sharingType === selectedType;

            if (matchesKeyword && matchesCategory && matchesType) {
                card.style.display = 'flex';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });

      
        let noResultsMsg = document.getElementById('noResultsMsg');
        if (visibleCount === 0) {
            if (!noResultsMsg) {
                noResultsMsg = document.createElement('div');
                noResultsMsg.id = 'noResultsMsg';
                noResultsMsg.style.cssText = 'grid-column: 1 / -1; text-align: center; padding: 40px; color: #64748b; background: #ffffff; border-radius: 8px; border: 1px dashed #cbd5e1; font-weight: 500;';
                noResultsMsg.innerText = 'No resources found matching your search/filter criteria.';
                catalogContainer.appendChild(noResultsMsg);
            }
            noResultsMsg.style.display = 'block';
        } else if (noResultsMsg) {
            noResultsMsg.style.display = 'none';
        }
    }

    
    if (searchInput) {
        searchInput.addEventListener('input', filterResources);
    }
    if (categorySelect) {
        categorySelect.addEventListener('change', filterResources);
    }
    if (typeSelect) {
        typeSelect.addEventListener('change', filterResources);
    }

    
    const searchForm = document.querySelector('form[action="index.php"]');
    if (searchForm) {
        searchForm.addEventListener('submit', (e) => {
            e.preventDefault();
            filterResources();
        });
    }
});