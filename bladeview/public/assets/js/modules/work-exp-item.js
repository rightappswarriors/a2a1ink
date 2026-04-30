import { cleanDeletedElement } from '../utilities/cleanDelEl.js';

document.addEventListener('DOMContentLoaded', function () {
    const workExpContainer = document.getElementById('work-exp-container');
    const workExpBtn = document.getElementById('work-exp-btn');

    const firstJbDscCnt = document.getElementById('first-job-desc-container');
    const firstAddJbDscBtnGrp = document.querySelector('.first-add-jbdsc-btn-group');
    const firstAddJbDscBtn = document.getElementById('add-job-desc-btn');

    let dscCount = firstJbDscCnt.querySelectorAll('.first-job-desc-item').length || 1;
    
    firstAddJbDscBtn.addEventListener('click', () => {
        dscCount = firstJbDscCnt.querySelectorAll('.first-job-desc-item').length +1;
        const firstNewDesc = document.createElement('div');
        firstNewDesc.classList.add('first-job-desc-item', 'mt-3', 'mr-3', 'ml-3', 'animate-fadeIn');

        firstNewDesc.innerHTML = `
            <div class="flex justify-between items-center">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Description ${dscCount}<span class="text-red-500 ml-3">*</span></label>
                <button type="button" class="first-rm-job-desc text-red-600 text-lg hover:text-red-400"><i class="fa-solid fa-trash"></i></button>
            </div>
            <textarea name="work_exp[0][job_desc][]" rows="3" class="w-full px-4 py-2 border-b-2 border-gray-600 focus:border-cyan-500 outline-none resize-vertical"></textarea>
        `;

        firstJbDscCnt.insertBefore(firstNewDesc, firstAddJbDscBtnGrp);

        firstNewDesc.querySelector('.first-rm-job-desc').addEventListener('click', () => {
            firstNewDesc.classList.add('animate-fadeOut');

            setTimeout(() => {
                firstNewDesc.remove();
                dscCount = cleanDeletedElement(firstJbDscCnt.querySelectorAll('.first-job-desc-item'), 'label', 'Description', `<span class="text-red-500 ml-3">*</span>`);
            }, 400);
            
        });
    });

    let workExpIndex = workExpContainer.querySelectorAll('.work-exp-item').length || 1;

    workExpBtn.addEventListener('click', function () {
        workExpIndex = workExpContainer.querySelectorAll('.work-exp-item').length + 1;
        const newWorkExpItem = document.createElement('div');
        newWorkExpItem.classList.add(
            'mt-6', 
            'work-exp-item', 
            'animate-fadeIn', 
            'border', 
            'border-2', 
            'border-slate-300', 
            'rounded-xl', 
            'p-3', 
            'grid', 
            'grid-cols-1', 
            'md:grid-cols-2', 
            'gap-8'
        );

        newWorkExpItem.innerHTML = `
            <div class="md:col-span-2 flex items-center justify-between">
                <h3 class="text-xl text-gray-700 font-bold px-3">Item ${workExpIndex}</h3>
                <button type="button" class="rm-work-exp text-red-600 text-2xl hover:text-red-400">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Company</label>
                <input type="text" name="work_exp[${workExpIndex}][job_company]" class="w-full px-4 py-2 border-b-2 border-gray-600 focus:border-cyan-500 outline-none" required>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Job Title</label>
                <input type="text" name="work_exp[${workExpIndex}][job_title]" class="w-full px-4 py-2 border-b-2 border-gray-600 focus:border-cyan-500 outline-none" required>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Job Period</label>
                <input type="text" name="work_exp[${workExpIndex}][job_period]" class="w-full px-4 py-2 border-b-2 border-gray-600 focus:border-cyan-500 outline-none" required>
            </div>
            <div class="md:col-span-2">
                <h3 class="text-gray-800 font-bold text-md mb-2">Job Description</h3>
                <div class="job-desc-container border-2 border-slate-300 rounded-lg p-3">
                    <div class="job-desc-item mt-3">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Description 1</label>
                        <textarea name="work_exp[${workExpIndex}][job_desc][]" rows="3" class="w-full px-4 py-2 border-b-2 border-gray-600 focus:border-cyan-500 outline-none resize-vertical"></textarea>
                    </div>
                    <div class="add-jbdsc-btn-group relative group inline-block mt-6">
                        <button type="button" class="add-job-desc text-sm bg-emerald-400 mt-4 px-3 py-2 rounded-md shadow-md hover:shadow-inner hover:bg-emerald-300 transition-all">
                            Add Another Description<i class="fa-solid fa-plus ml-2"></i>
                        </button>
                        <span class="absolute -top-3 left-3/4 -translate-x-1/2 bg-gray-800 text-white text-xs rounded-md px-2 py-1 opacity-0 group-hover:opacity-100 transition-opacity duration-300 [transition-delay:300ms] pointer-events-none whitespace-nowrap shadow-md">
                            Add another job description for item ${workExpIndex}
                        </span>
                    </div>
                </div>
            </div>
        `;

        workExpContainer.appendChild(newWorkExpItem);

        newWorkExpItem.querySelector('.rm-work-exp').addEventListener('click', () => {
            workExpContainer.classList.remove('animate-fadeIn');
            workExpContainer.classList.add('animate-fadeOut');

            setTimeout(() => {
                newWorkExpItem.remove();
                workExpIndex = cleanDeletedElement(workExpContainer.querySelectorAll('.work-exp-item'), 'h3', 'Item');
            }, 400);
            
        });

        const jobDescContainer = newWorkExpItem.querySelector('.job-desc-container');
        const addJobDescBtn = newWorkExpItem.querySelector('.add-job-desc');
        
        let jobDescCount = jobDescContainer.querySelectorAll('.job-desc-item').length || 1;

        addJobDescBtn.addEventListener('click', function () {
            jobDescCount = jobDescContainer.querySelectorAll('.job-desc-item').length + 1;
            const newDesc = document.createElement('div');
            newDesc.classList.add('job-desc-item', 'mt-3', 'animate-fadeIn');
            newDesc.innerHTML = `
                <div class="flex justify-between items-center">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Description ${jobDescCount}<span class="text-red-500 ml-3">*</span></label>
                    <button type="button" class="rm-job-desc text-red-600 text-lg hover:text-red-400"><i class="fa-solid fa-trash"></i></button>
                </div>
                <textarea name="work_exp[${workExpIndex}][job_desc][]" rows="3" class="w-full px-4 py-2 border-b-2 border-gray-600 focus:border-cyan-500 outline-none resize-vertical"></textarea>
            `;

            jobDescContainer.insertBefore(newDesc, newWorkExpItem.querySelector('.add-jbdsc-btn-group'));

            newDesc.querySelector('.rm-job-desc').addEventListener('click', function () {
                jobDescContainer.classList.remove('animate-fadeIn');
                jobDescContainer.classList.add('animate-fadeOut');

                setTimeout(() => {
                    newDesc.remove();
                    jobDescCount = cleanDeletedElement(jobDescContainer.querySelectorAll('.job-desc-item'), 'label', 'Description', `<span class="text-red-500 ml-3">*</span>`)
                });
                
            });
        });
    });
});
