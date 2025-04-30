<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Elementor_Custom_Timeline_Widget extends Widget_Base {

	public function get_name() {
		return 'custom_timeline';
	}

	public function get_title() {
		return __( 'Custom Timeline', 'custom-elementor' );
	}

	public function get_icon() {
		return 'eicon-timeline';
	}

	public function get_categories() {
		return [ 'general' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Timeline Steps', 'custom-elementor' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'icon_url',
			[
				'label' => __( 'Icon URL', 'custom-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'https://img.icons8.com/fluency/48/consulting.png',
			]
		);

		$repeater->add_control(
			'title',
			[
				'label' => __( 'Title', 'custom-elementor' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Step Title', 'custom-elementor' ),
			]
		);

		$repeater->add_control(
			'description',
			[
				'label' => __( 'Description', 'custom-elementor' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'Step description goes here.', 'custom-elementor' ),
			]
		);

		$this->add_control(
			'steps',
			[
				'label' => __( 'Steps', 'custom-elementor' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[ 'title' => 'Initial Consultation', 'description' => 'And Needs Assessment', 'icon_url' => 'https://img.icons8.com/fluency/48/consulting.png' ],
					[ 'title' => 'Custom IT Strategy', 'description' => 'Development', 'icon_url' => 'https://img.icons8.com/color/48/strategy-board.png' ],
					[ 'title' => 'Service Implementation', 'description' => 'And Seamless Onboarding', 'icon_url' => 'https://img.icons8.com/color/48/agreement.png' ],
					[ 'title' => 'Continuous Monitoring', 'description' => 'Maintenance, And Support', 'icon_url' => 'https://img.icons8.com/color/48/system-task.png' ],
					[ 'title' => 'Quarterly Reviews', 'description' => 'And Optimization', 'icon_url' => 'https://img.icons8.com/color/48/combo-chart--v1.png' ],
				],
			]
		);

		$this->end_controls_section();
	}

	public function render() {
		$settings = $this->get_settings_for_display();
		$steps = $settings['steps'];
		?>

		<style>
		.timeline-container {
		  max-width: 1200px;
		  margin: auto;
		  position: relative;
		  padding: 40px 20px;
		}
		.timeline {
		  display: flex;
		  justify-content: space-between;
		  position: relative;
		  flex-wrap: wrap;
		}
		.timeline::before {
		  content: "";
		  position: absolute;
		  top: 50%;
		  left: 5%;
		  width: 90%;
		  height: 6px;
		  background-color: #ffffff;
		  box-shadow: 0px 0px 20px 0px #7a7a7a78;
		  z-index: 1;
		  transform: translateY(20px);
		}
		.step {
		  /*flex: 1 1 150px;*/
		  min-width: 150px;
		  max-width: 200px;
		  position: relative;
		  text-align: center;
		  z-index: 2;
		  margin-bottom: 40px;
		}
		.step img {
		  width: 60px;
		  height: 60px;
		  margin: 0 auto 10px;
		}
		.step-circle {
		  width: 40px;
		  height: 40px;
		  background-color: #fff;
		  border-radius: 50%;
		  border: 2px solid #dbe4f3;
		  display: flex;
		  align-items: center;
		  justify-content: center;
		  color: #3498db;
		  font-weight: bold;
		  font-size: 14px;
		  margin: 10px auto;
		  box-shadow: 0 0 8px rgba(0,0,0,0.05);
		}
		.top {
		  display: flex;
		  flex-direction: column;
		  align-items: center;
		  margin-bottom: 50px;
		}
		.bottom {
		  display: flex;
		  flex-direction: column;
		  align-items: center;
		  margin-top: 30px;
		  transform: translateY(105px);
		}
		.step p {
		  font-size: 16px;
		  font-weight: 700;
		  color: #000;
		  margin: 0;
		}
		
		
    	.top, .bottom {
          display: flex;
          flex-direction: column;
          align-items: center;
          gap: 10px;
        }
        
        /* Move bottom steps slightly for desktop only */
        @media screen and (min-width: 769px) {
          .bottom {
            margin-top: 30px;
            transform: translateY(105px);
          }
        }
        
        /* Tablet and mobile responsiveness */
        @media screen and (max-width: 768px) {
          .timeline {
            flex-direction: column;
            align-items: center;
          }
        
          .timeline::before {
            display: none;
          }
        
          .step {
            max-width: 100%;
            margin: 20px 0;
          }
        
          .top, .bottom {
            margin: 0;
            transform: none;
            gap: 10px;
          }
        
          .top > .step-circle,
          .bottom > .step-circle {
            order: 1;
          }
        
          .top > img,
          .bottom > img {
            order: 2;
          }
        
          .top > p,
          .bottom > p {
            order: 3;
          }
        }	
		
		</style>

		<div class="timeline-container">
		  <div class="timeline">
		    <?php foreach ( $steps as $index => $step ) : ?>
		      <div class="step">
		        <div class="<?php echo $index % 2 === 0 ? 'top' : 'bottom'; ?>">
		          <?php if ($index % 2 !== 0) echo '<div class="step-circle">'.sprintf('%02d', $index + 1).'</div>'; ?>
		          <img src="<?php echo esc_url($step['icon_url']); ?>" alt="Icon" />
		          <p><?php echo esc_html($step['title']); ?><br><?php echo esc_html($step['description']); ?></p>
		          <?php if ($index % 2 === 0) echo '<div class="step-circle">'.sprintf('%02d', $index + 1).'</div>'; ?>
		        </div>
		      </div>
		    <?php endforeach; ?>
		  </div>
		</div>

		<?php
	}
}
