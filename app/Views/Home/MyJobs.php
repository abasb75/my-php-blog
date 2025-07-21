<?php 

namespace App\Views\Home;

use App\Models\Job;
use App\Views\General\Style;

class MyJobs{

    static function jobs(){
        $jobs = Job::selectAll();
        
        $res = "";
        foreach($jobs as $i=>$job){
            $image = $job['image'];
            $suitcase = $job['suitcase'];
            $intro = $job['intro'];
            $organ = $job['organ'];
            $href = $job['link'];

            $res .= <<<HTML
            <div class="job">
                <div class="image-holder">
                    <img src="$image" alt="$suitcase" width="200" height="200"/>
                    <div class="back-drop"></div>
                </div>
                <div class="content">
                    <div class="title">
                        <div class="job-title">
                            <span class="icon icon-suitcase"></span>
                            <span>$suitcase</span>
                        </div>
                        <div class="job-company">
                            <span class="icon icon-business"></span>
                            <a href="$href" target="_blank" title="$organ">
                                <span>$organ</span></a>
                            </div>
                        <div class="job-duration">
                            <span class="icon icon-hourglass" style="font-size:.875rem;">
                            </span><span>$suitcase</span>
                        </div>
                    </div>
                    <p>$intro</p>
                </div>
            </div>
HTML;
        }
        return $res;
    }
    static function render(){
        Style::require('home.my-jobs');
        $sectionTitle = SectionTitle::render('سوابق شغلی من');
        $jobs = self::jobs();
        return <<<HTML
        <div id="my-jobs">
            <div class="content">
                $sectionTitle
                <div class="jobs">
                    $jobs
                </div>
            </div>
        </div>

HTML;
    }
}
