This is the pagebuilder instructions

- Each file within this `resources/views/page_builder/` directory is used within the pagebuilder as a component
- Each component is directly linked with statamic CMS so all content is managed
- We've created fieldsets for you to choose from. read thorougly for specific usage `resources/views/fieldset/fieldset-instructions.md`
- Every component is build the same way
- Scan each file within `resources/views/page_builder/` to get an understanding
- Do not add any margin tops or bottoms to create space between components. This is handled within the spacing.css file
- Before starting or outputting scan these instructions before and after and validate if indeed the chosen reasoning aligns with the instructions
- Only act when you are 100% sure. Do not act or do anything if you miss any information.
- When implementing and reasoning log only the relevant tasks you are doing, like when you are reading instructions when you aren't sure anymore
- After each task always ask yourself if you still have enough background information to continue the task. If not rescan instructions and file as explained


Each time you edit or create a pagebuilder component do the following to get full background information to ensure the right reasoning:
- Scan the pagebuilder instructions thoroughly on how to use in `resources/views/page_builder/pagebuilder-instructions.md`
- Scan each file/component within `resources/views/page_builder/` on how it is build
- Scan the fieldset instructions thoroughly on how to use in `resources/views/fieldset/fieldset-instructions.md`
- Scan each file/fieldset within `resources/views/fieldset` including comments.


HTML structure:
1. First <div should only have 2 classes: "component" and what kind of component it is or what it does "title-media"
2. Second <div should have only one class if it needs a container "container"

Which results in:
<div class="component title-media">
    <div class="container">

    </div>
</div>    

3. After the first 2 divs you are now free to use necesary html to build your component
4. Since you are now starting to need content within your component you are going to use the fieldset components

Which results in:

<div class="component title-media">
    <div class="container"> 
        <x-fieldset.title :title="$title?->value" class="mb-5" />
        <x-fieldset.content :content="$content?->value" class="mb-8" />
        <x-fieldset.media :media="$media?->value" class="h-50 lg:h-70 w-1/2" />
    </div>
</div>    

5. If you need to wrap fieldset components together with a div for styling purposes always ensure that the wrapper isn't shown when both fieldsets don't have any content so the DOM doesnt get bloated by unused elements. The correct if statement can be copied that is being used within the fieldset files.

For example:

<div class="component title-media">
    <div class="container"> 
        <x-fieldset.title :title="$title?->value" class="mb-5" />

        @if()
            <div class="flex gap-x-10">    
                <x-fieldset.content :content="$content?->value" class="mb-8 w-1/2" />
                <x-fieldset.media :media="$media?->value" class="h-50 lg:h-70 w-1/2" />
            </div>
        @endif
    </div>
</div>   

