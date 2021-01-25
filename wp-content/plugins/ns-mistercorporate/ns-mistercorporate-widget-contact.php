<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*
 * Add Button Contact Widget.
 */
class Mistercorporate_Contact_Widget extends WP_Widget {

    /* Register widget. */
    function __construct() {
        parent::__construct(
            'mistercorporate_contact_widget', // Base ID
            esc_html__( 'Mistercorporate Contact', 'mistercorporate' ), // Name
            array( 'description' => esc_html__( 'Mistercorporate Contact Button', 'mistercorporate' ), ) // Args
        );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        echo $args['before_widget'];
        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] .'<a href="#MistercorporateModal" role="button" class="btn btn-default btn-mini" data-toggle="modal">'.apply_filters( 'widget_title', $instance['title'] ).'</a>'. $args['after_title'];
        }
        echo $args['after_widget'];
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Contact us', 'mistercorporate' );
        ?>
        <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Button Label:', 'mistercorporate' ); ?></label> 
        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <?php 
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

        return $instance;
    }

} // class Mistercorporate_Contact_Widget


// register Foo_Widget widget
function mistercorporate_register_foo_widget() {
    register_widget( 'Mistercorporate_Contact_Widget' );
}
add_action( 'widgets_init', 'mistercorporate_register_foo_widget' );    