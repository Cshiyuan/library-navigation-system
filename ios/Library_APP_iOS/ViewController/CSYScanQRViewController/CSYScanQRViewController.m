//
//  CSYScanQRViewController.m
//  Library_APP_iOS
//
//  Created by chenshyiuan on 2017/3/8.
//  Copyright © 2017年 chenshyiuan. All rights reserved.
//

#import "CSYScanQRViewController.h"
#import <AVFoundation/AVFoundation.h>

@interface CSYScanQRViewController () <AVCaptureMetadataOutputObjectsDelegate>
{
    __weak IBOutlet UIButton *_crossButton;
    __weak IBOutlet UIView *_topView;
    __weak IBOutlet UIView *_topStatusView;
    __weak IBOutlet UILabel *_showInfoLabel;
    __weak IBOutlet UIView *_bottomView;
    
    AVCaptureSession *_captureSession;
    AVCaptureVideoPreviewLayer *_videoPreviewLayer;
    UIView *_qrCodeFrameView;
    NSString *_keyScanString;
}

@end

@implementation CSYScanQRViewController

- (void)viewDidLoad {
    [super viewDidLoad];
    
    _keyScanString = @"x";
    [_crossButton addTarget:self action:@selector(crossButtonAction:) forControlEvents:UIControlEventTouchUpInside];
    
    [self.view setBackgroundColor:[UIColor whiteColor]];
    
    AVCaptureDevice *captureDevice = [AVCaptureDevice defaultDeviceWithMediaType:AVMediaTypeVideo];
    
    AVCaptureDeviceInput* input = [[AVCaptureDeviceInput alloc]initWithDevice:captureDevice error:nil];
    
    _captureSession = [[AVCaptureSession alloc]init];
    
    [_captureSession addInput:input];
    
    AVCaptureMetadataOutput *captureMetadataOutput = [[AVCaptureMetadataOutput alloc]init];
    
    [_captureSession addOutput:captureMetadataOutput];
    
    [captureMetadataOutput setMetadataObjectsDelegate:self queue:dispatch_get_main_queue()];
    captureMetadataOutput.metadataObjectTypes = @[AVMetadataObjectTypeQRCode];
    
    _videoPreviewLayer = [AVCaptureVideoPreviewLayer layerWithSession:_captureSession];
    _videoPreviewLayer.videoGravity = AVLayerVideoGravityResizeAspectFill;
    _videoPreviewLayer.frame = self.view.layer.bounds;
    [self.view.layer addSublayer:_videoPreviewLayer];
    
    [_captureSession startRunning];
    
    
    [self.view bringSubviewToFront:_topView];
    [self.view bringSubviewToFront:_topStatusView];
    [self.view bringSubviewToFront:_bottomView];

    _qrCodeFrameView = [[UIView alloc]init];
    _qrCodeFrameView.layer.borderColor = [UIColor greenColor].CGColor;
    _qrCodeFrameView.layer.borderWidth = 2;
    [self.view addSubview:_qrCodeFrameView];
    [self.view bringSubviewToFront:_qrCodeFrameView];
    
    
    self.navigationController.navigationBarHidden = YES;
}

- (void)didReceiveMemoryWarning {
    [super didReceiveMemoryWarning];
    // Dispose of any resources that can be recreated.
}

#pragma -mark AVCaptureMetadataOutputObjectsDelegate
- (void)captureOutput:(AVCaptureOutput *)captureOutput didOutputMetadataObjects:(NSArray *)metadataObjects fromConnection:(AVCaptureConnection *)connection
{
    if(metadataObjects.count == 0 || metadataObjects == nil)
    {
        _qrCodeFrameView.frame = CGRectZero;
        return;
    }

    AVMetadataMachineReadableCodeObject *metadataObj = metadataObjects[0];
    if (metadataObj.type == AVMetadataObjectTypeQRCode) {
        AVMetadataObject *barCodeObject = [_videoPreviewLayer transformedMetadataObjectForMetadataObject:metadataObj];
        
        _qrCodeFrameView.frame = barCodeObject.bounds;
        
        if(metadataObj.stringValue != nil)
        {
            
            //1.创建正则表达式，[0-9]:表示‘0’到‘9’的字符的集合
            NSString *pattern = @"F[0-9][0-9][0-9][0-9]";
            //1.1将正则表达式设置为OC规则
            NSRegularExpression *regular = [[NSRegularExpression alloc] initWithPattern:pattern options:NSRegularExpressionCaseInsensitive error:nil];
            
            NSUInteger numberofMatch = [regular numberOfMatchesInString:metadataObj.stringValue
                                                                          options:NSMatchingReportProgress
                                                                            range:NSMakeRange(0, metadataObj.stringValue.length)];
            
            _showInfoLabel.text = [NSString stringWithFormat:@"%@%@",@"扫码信息:",metadataObj.stringValue];
            if(_keyScanString != metadataObj.stringValue)
            {
                _keyScanString = metadataObj.stringValue;
                if(_scanInfoFromQRBlock && numberofMatch > 0)
                {
                    _scanInfoFromQRBlock(metadataObj.stringValue);
                    [self dismissViewControllerAnimated:YES completion:nil];
                }
            }
        }
        
    }
}

-(void)crossButtonAction:(UIButton*)btn
{
//    [self.navigationController.p]
    [self dismissViewControllerAnimated:YES completion:nil];
}

#pragma -mark 定制statusBar部分
-(UIStatusBarStyle)preferredStatusBarStyle
{
    return UIStatusBarStyleLightContent;
}



@end
