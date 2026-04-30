import { cleanDeletedElement } from '../utilities/cleanDelEl.js';

document.addEventListener("DOMContentLoaded", function () {
    const skillsContainer = document.getElementById('skll-container');
    const skillBtn = document.getElementById('skill-btn');

    let skillItems = skillsContainer.querySelectorAll('skill-item').length || 1;

    skillBtn.addEventListener('click', function () {
        skillItems = skillsContainer.querySelectorAll('.skill-item').length+1;
        const newSklItem = document.createElement('div');
        newSklItem.classList.add('mt-3', 'skill-item', 'animate-fadeIn');

        newSklItem.innerHTML = `
            <p class="block text-sm font-semibold text-gray-700 mb-1">Skill ${skillItems}<span class="text-red-500 ml-3">*</span></p>
            <div class="flex items-center">
                <input type="text" name="appli_skills[]" class="w-full px-4 py-2 border-b-2 border-gray-600 focus:outline-none focus:border-cyan-500 transition duration-300" required>
                <button type="button" class="px-3 py-2 text-2xl text-red-600 hover:text-glow-red focus:text-red-400 transition-all duration:300"><i class="fa-solid fa-trash"></i></button>
            </div>
        `;
        
        skillsContainer.appendChild(newSklItem);
            
        newSklItem.querySelector('button').addEventListener('click', function () {
            newSklItem.classList.remove('animate-fadeIn');
            newSklItem.classList.add('animate-fadeOut');

            setTimeout(() => {
                newSklItem.remove();
                skillItems = cleanDeletedElement(skillsContainer.querySelectorAll('.skill-item'), 'p', 'Skill', `<span class="text-red-500 ml-3">*</span>`);
            }, 400);
            
        });
    });
});