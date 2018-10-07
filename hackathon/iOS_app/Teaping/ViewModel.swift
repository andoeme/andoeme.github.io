//
//  ViewModel.swift
//  Teaping
//
//  Created by Małgorzata Dziubich on 06/10/2018.
//  Copyright © 2018 GGC. All rights reserved.
//

import Alamofire
import Foundation

final class ViewModel {

    var amount: Int = 0

    private let baseURL = ""

    func completeCharge(with token: STPToken, completion: @escaping (Result<Void>) -> Void) {

        //TODO: add backend implementation
        completion(Result.success(Void()))

//        let url = baseURL.appending("charge")
//        let params: [String: Any] = [
//            "token": token.tokenId,
//            "amount": amount,
//            "currency": "$",
//            "description": "Teaping"
//        ]
//
//        Alamofire.request(url, method: .post, parameters: params)
//            .validate(statusCode: 200..<300)
//            .responseString { response in
//                switch response.result {
//                case .success:
//                    completion(Result.success(Void()))
//                case .failure(let error):
//                    completion(Result.failure(error))
//                }
//            }
    }

    func formatAmount(from amountString: String) -> Int? {
        let newString = amountString.components(separatedBy: CharacterSet.decimalDigits.inverted).joined()
        return Int(newString)
    }
}
