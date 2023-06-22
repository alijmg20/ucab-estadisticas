<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4 mt-4">
    <div class="counter-container flex-col" x-data="{ count_projects: +0 }">
        <i class="fas fa-book text-blue-700" style="font-size: 10rem;"></i>
        <div class="counter_projects counter" x-text="count"></div>
        <div style="font-weight: 400;">{{__('Proyectos Realizados')}}</div>
    </div>
    <div class="counter-container flex-col" x-data="{ count_excelent: 0% }">
        <i class="fas fa-medal text-blue-700" style="font-size: 10rem;"></i>
        <div class="counter_excelent counter" x-text="count"></div>
        <div style="font-weight: 400;">{{__('Comprometidos con la excelencia')}}</div>
    </div>
    <div class="counter-container flex-col" x-data="{ count_researchers: +0 }">
        <i class="fas fa-graduation-cap text-blue-700" style="font-size: 10rem;"></i>
        <div class="counter_researchers counter" x-text="count"></div>
        <div style="font-weight: 400;">{{__('Investigadores Reconocidos')}}</div>
    </div>
</div>

<script>
    var count_projects = 0;
    var counter_projects = setInterval(function() {
        count_projects++;
        document.querySelector('.counter_projects').textContent = '+' + count_projects;
        if (count_projects == 100) {
            clearInterval(counter_projects);
        }
    }, 30);

    var count_excelent = 0;
    var counter_excelent = setInterval(function() {
        count_excelent++;
        document.querySelector('.counter_excelent').textContent = count_excelent + '%';
        if (count_excelent == 100) {
            clearInterval(counter_excelent);
        }
    }, 30);

    var count_researchers = 0;
    var counter_researchers = setInterval(function() {
        count_researchers++;
        document.querySelector('.counter_researchers').textContent = '+' + count_researchers;
        if (count_researchers == 20) {
            clearInterval(counter_researchers);
        }
    }, 150);
</script>