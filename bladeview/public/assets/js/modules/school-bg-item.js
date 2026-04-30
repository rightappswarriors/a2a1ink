import { cleanDeletedElement } from "../utilities/cleanDelEl.js";

document.addEventListener('DOMContentLoaded', function() {
    const schBgContainer = document.getElementById('sch-bg-container');
    const schAddBtn = document.getElementById('edu-back');

    let schItemsCount = schBgContainer.querySelectorAll('.sch-bg-item').length || 1;
    
    schAddBtn.addEventListener('click', function() {
        schItemsCount = schBgContainer.querySelectorAll('.sch-bg-item').length + 1;
        const newSchItem = document.createElement('div');
        newSchItem.classList.add(
            'sch-bg-item',
            'mt-6',
            'border', 
            'border-2', 
            'border-slate-300', 
            'rounded-xl', 
            'p-3', 
            'grid', 
            'grid-cols-1', 
            'md:grid-cols-2', 
            'gap-8',
            'animate-fadeIn'
        );

        newSchItem.innerHTML = `
            <div class="md:col-span-2 flex items-center justify-between">
                <h3 class="text-xl text-gray-700 font-bold px-3">Item ${schItemsCount}</h3>
                <button type="button" class="rm-sch-bg-item text-red-600 text-2xl hover:text-red-400">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </div>
            <div>
                <label for="bach_degr" class="block text-sm font-semibold text-gray-700 mb-1">School Degree<span class="text-red-500 ml-3">*</span></label>
                <input type="text" id="bach-degr" name="school_bg[${schItemsCount}][bach_degr]" class="w-full px-4 py-2 border-b-2 border-gray-600 focus:outline-none focus:border-cyan-500 transition duration-300" required>
            </div>
            <div>
                <label for="insti" class="block text-sm font-semibold text-gray-700 mb-1">Institution<span class="text-red-500 ml-3">*</span></label>
                <input type="text" id="insti" name="school_bg[${schItemsCount}][insti]" class="w-full px-4 py-2 border-b-2 border-gray-600 focus:outline-none focus:border-cyan-500 transition duration-300" required>
            </div>
            <div>
                <label for="sch_year" class="block text-sm font-semibold text-gray-700 mb-1">Academic Year<span class="text-red-500 ml-3">*</span></label>
                <input type="text" id="sch_year" name="school_bg[${schItemsCount}][sch_year]" class="w-full px-4 py-2 border-b-2 border-gray-600 focus:outline-none focus:border-cyan-500 transition duration-300" required>
            </div>
            <div class="md:col-span-2">
                <h3 class="text-gray-800 font-bold text-md">Awards<span class="text-gray-500 ml-3">(optional)</span></h3>
                <div class="sch-awards-container rounded-lg border-2 border-slate-300">
                    <div class="sch-awards-item mt-3 ml-3 mr-3">
                        <label for="sch_award" class="block text-sm font-semibold text-gray-700 mb-1">Award 1</label>
                        <textarea id="sch_award" name="school_bg[${schItemsCount}][sch_award][]" rows="4" class="w-full px-4 py-2 border-b-2 border-gray-600 focus:outline-none focus:border-b-3 focus:border-cyan-500 transition duration-300 resize-vertical"></textarea>
                    </div>
                    <div class="sch-awrd-btn-grp relative group inline-block mt-6">
                        <button type="button" class="add-sch-award-btn text-sm bg-emerald-400 px-3 py-2 rounded-md shadow-md focus:bg-emerald-300 hover:shadow-inner hover:shadow-emerald-600 transition-all duration:300 mt-4">
                            Add Another Award<i class="fa-solid fa-plus ml-2 text-slate-500"></i>
                        </button>
                        <span class="absolute -top-3 left-3/4 -translate-x-1/2 bg-gray-800 text-white text-xs rounded-md px-2 py-1 opacity-0 group-hover:opacity-100 transition-opacity duration-300 [transition-delay:300ms] pointer-events-none whitespace-nowrap shadow-md">
                            Add another award for item ${schItemsCount}
                        </span>
                    </div>
                </div>
            </div>
        `;

        schBgContainer.appendChild(newSchItem);

        newSchItem.querySelector('.rm-sch-bg-item').addEventListener('click', () => {
            newSchItem.classList.remove('animate-fadeIn');
            newSchItem.classList.add('animate-fadeOut');

            setTimeout(() => {
                newSchItem.remove();
                schItemsCount = cleanDeletedElement(schBgContainer.querySelectorAll('.sch-bg-item'), 'h3', 'Item');
            }, 400);

        });

        const shcAwardContainer = newSchItem.querySelector('.sch-awards-container');
        const dynSchAwrdAddBtn = newSchItem.querySelector('.add-sch-award-btn');
        const dynSchAwardBtnGrp = newSchItem.querySelector('.sch-awrd-btn-grp');
        
        let schAwrdsItemsCount = shcAwardContainer.querySelectorAll('.sch-awards-item').length || 1;

        dynSchAwrdAddBtn.addEventListener('click', () => {
            schAwrdsItemsCount = newSchItem.querySelectorAll('.sch-awards-item').length + 1;
            const newDynSchAwrdItem = document.createElement('div');

            newDynSchAwrdItem.classList.add(
                'sch-awards-item',
                'mt-3',
                'ml-3',
                'mr-3',
                'animate-fadeIn'
            );

            newDynSchAwrdItem.innerHTML = `
                <div class="flex justify-between items-center">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Award ${schAwrdsItemsCount}</label>
                    <button type="button" class="first-rm-shc-awrd text-red-600 text-lg hover:text-red-400"><i class="fa-solid fa-trash"></i></button>
                </div>
                <textarea name="school_bg[${schItemsCount}][sch_award][]" rows="3" class="w-full px-4 py-2 border-b-2 border-gray-600 focus:border-cyan-500 outline-none resize-vertical"></textarea>
            `;

            shcAwardContainer.insertBefore(newDynSchAwrdItem, dynSchAwardBtnGrp);

            newDynSchAwrdItem.querySelector('.first-rm-shc-awrd').addEventListener('click', () => {
                newDynSchAwrdItem.classList.remove('animate-fadeIn');
                newDynSchAwrdItem.classList.add('animate-fadeOut');

                setTimeout(() => {
                    newDynSchAwrdItem.remove();
                    schAwrdsItemsCount = cleanDeletedElement(newDynSchAwrdItem.querySelectorAll('.sch-awards-item'), 'label', 'Award');
                }, 400);
                
            });
        });
    });

    const firstSchAwrdsContainer = document.getElementById('first-sch-awards-container');
    const firstAddAwrdsBtn = document.getElementById('first-sch-award-btn');
    const firstSchAwrdBtnGrp = document.querySelector('.first-sch-awrd-btn-grp');

    let firstSchAwrdsItems = firstSchAwrdsContainer.querySelectorAll('.first-sch-awards-item').length || 1;

    firstAddAwrdsBtn.addEventListener('click', () => {
        firstSchAwrdsItems = firstSchAwrdsContainer.querySelectorAll('.first-sch-awards-item').length + 1;
        const newFirstAwardsItem = document.createElement('div');

        newFirstAwardsItem.classList.add(
            'first-sch-awards-item',
            'mt-3',
            'ml-3',
            'mr-3',
            'animate-fadeIn'
        );

        newFirstAwardsItem.innerHTML = `
            <div class="flex justify-between items-center">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Award ${firstSchAwrdsItems}</label>
                <button type="button" class="first-rm-shc-awrd text-red-600 text-lg hover:text-red-400"><i class="fa-solid fa-trash"></i></button>
            </div>
            <textarea name="school_bg[0][sch_award][]" rows="3" class="w-full px-4 py-2 border-b-2 border-gray-600 focus:border-cyan-500 outline-none resize-vertical"></textarea>
        `;

        firstSchAwrdsContainer.insertBefore(newFirstAwardsItem, firstSchAwrdBtnGrp);

        newFirstAwardsItem.querySelector('.first-rm-shc-awrd').addEventListener('click', () => {
            newFirstAwardsItem.classList.add('animate-fadeOut');

            setTimeout(() => {
                newFirstAwardsItem.remove();
                firstSchAwrdsItems = cleanDeletedElement(firstSchAwrdsContainer.querySelectorAll('.first-sch-awards-item'), 'label', 'Award');
            });

        });
    })
});