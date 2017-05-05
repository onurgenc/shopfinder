<?php
    namespace Ogenc\Shopfinder\Controller\Adminhtml\Shop;

    use Magento\Backend\App\Action;
    use Magento\Framework\App\Filesystem\DirectoryList;
    use Magento\Framework\Model\Exception;

    class Save extends \Magento\Backend\App\Action
    {

        /**
         * @var \Magento\Framework\View\Result\PageFactory
         */
        public function execute()
        {
            $data = $this->getRequest()->getParams();
            if ($data) {
                $model = $this->_objectManager->create('Ogenc\Shopfinder\Model\Shop');
                $id = $this->getRequest()->getParam('id');
                if ($id) {
                    $model->load($id);
                }
                if (isset($data['image']['delete'])) {
                    $mediaDirectory = $this->_objectManager->get('Magento\Framework\Filesystem')->getDirectoryRead(DirectoryList::MEDIA);
                    $path = $mediaDirectory->getAbsolutePath($data['image']['value']);
                    if (file_exists($path)) {
                        unlink($path);
                    }
                    $data['image'] = null;
                }
                if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {
                    try {
                        $uploader = $this->_objectManager->create('Magento\MediaStorage\Model\File\Uploader',
                            ['fileId' => 'image']);
                        $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
                        $uploader->setAllowRenameFiles(true);
                        $uploader->setFilesDispersion(false);
                        $mediaDirectory = $this->_objectManager->get('Magento\Framework\Filesystem')->getDirectoryRead(DirectoryList::MEDIA);
                        $result = $uploader->save($mediaDirectory->getAbsolutePath('shopfinder/images/'));
                        unset($result['tmp_name']);
                        unset($result['path']);
                        $data['image'] = "shopfinder/images/".$result['file'];
                    } catch (Exception $e) {
                        $data['image'] = "shopfinder/images/".$_FILES['image']['name'];
                    }
                } else {
                    $data['image'] = $model->getData('image');
                }
                $check = $this->_objectManager->create('Ogenc\Shopfinder\Model\ResourceModel\Shop\Collection');
                if ($check->hasIdentifier($data['identifier'], $model->getData('id'))) {
                    $this->messageManager->addError("identifier already setted another shop");
                } else {
                    $model->setData($data);
                    try {
                        $model->save();
                        $this->messageManager->addSuccess(__('Shop Has been Saved.'));
                        $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);
                        if ($this->getRequest()->getParam('back')) {
                            $this->_redirect('*/*/edit', ['id' => $model->getId(), '_current' => true]);

                            return;
                        }
                        $this->_redirect('*/*/');

                        return;
                    } catch (\Magento\Framework\Model\Exception $e) {
                        $this->messageManager->addError($e->getMessage());
                    } catch (\RuntimeException $e) {
                        $this->messageManager->addError($e->getMessage());
                    } catch (\Exception $e) {
                        $this->messageManager->addError($e->getMessage());
                        $this->messageManager->addException($e, __('Something went wrong while saving the image.'));
                    }
                }
                $this->_getSession()->setFormData($data);
                $this->_redirect('*/*/edit', ['image_id' => $this->getRequest()->getParam('image_id')]);

                return;
            }
            $this->_redirect('*/*/');
        }
    }
