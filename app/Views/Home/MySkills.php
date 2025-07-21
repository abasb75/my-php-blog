<?php 

namespace App\Views\Home;

use App\Models\Skill;
use App\Views\General\Style;

class MySkills{

    static function skills(){
        $skills = Skill::selectAll();
        $res = "";
        foreach($skills as $i=>$skill){
            $link = $skill['link'];
            $name_fa = $skill['name_fa'];
            $name_en = $skill['name_en'];
            $res .= <<<HTML
            <a href="$link" title="$name_fa" target="_blank">
                <div class="skill-item">
                    <div class="content">
                        <div class="imageHolder">
                            <img 
                            src="/asset/image/skill/logo-$name_en.svg" 
                            alt="{{ skills.name_fa }}"
                            width="100"
                            height="100"
                            >
                        </div>
                        <div class="title">$name_fa</div>
                    </div>
                </div>
            </a>
HTML;
        }
        return $res;
    }

    static function render(){
        Style::add('home.my-skills');
        $sectionTitle = SectionTitle::render('مهارتهای من');
        $skills = self::skills();
        return <<<HTML
        <div id="my-skills">
            <div class="bg-box">
                <div class="blue"></div>
            </div>
            <div class="content">
                $sectionTitle
                <div class="skills-holder">
                    $skills
                </div>
            </div>
        </div>
HTML;
    }
}
