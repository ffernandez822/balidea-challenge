<?php

/**
 * @file
 * Contains Drupal\balidea_form\Form\ConfigForm
 */

namespace Drupal\balidea_form\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class ConfigForm extends ConfigFormBase {
    /**
     * {@inheritdoc}
     */
    protected function getEditableConfigNames() {  
        return [  
          'balidea_form.adminsettings',  
        ];  
      }
    /**  
     * {@inheritdoc}  
     */

    public function getFormId(){
        return 'config_form';
    }

    public function buildForm(array $form, FormStateInterface $form_state) {  
        
        $config = $this->config('balidea_form.adminsettings'); 


        $form['texto'] = array(
            '#type' => 'text_format',
            '#title' => $this->t('Texto'),
            '#default_value' =>json_decode($config->get('texto'))->value,
            '#format' => 'full_html',
            '#required'=>TRUE,
            '#maxlenght'=> 250,
            '#description' => $this->t('Max lenght 250 characters'), 

        );
        $form['entero'] = array(
            '#type' => 'number',
            '#title' => $this->t('Entero'),
            '#required' => true,
            '#default_value' => $config->get('entero'),
            '#description' => $this->t('Only numbers integer'), 

          );

        $form['actions']['#type'] = 'actions';
        $form['actions']['submit'] = [
        '#type' => 'submit',
        '#button_type' => 'primary',
        '#default_value' => $this->t('Guardar') ,
        ];
        $form['#theme'] = 'balidea_form';
        $form['#attached']['library'][] = 'balidea_form/balidea-styling';

    return $form;

        //return parent::buildForm($form, $form_state);  
    }

    public function submitForm(array &$form, FormStateInterface $form_state) {


        parent::submitForm($form, $form_state);  
        
        $this->config('balidea_form.adminsettings')  
        ->set('texto', json_encode($form_state->getValue('texto')))
        ->set('entero', $form_state->getValue('entero'))  
          ->save();  
      } 
}

